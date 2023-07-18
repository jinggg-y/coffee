<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CourseModel;
use App\Models\ImageModel;
use App\Models\ReviewModel;

require_once '/var/www/htdocs/vendor/autoload.php';
use Dompdf\Dompdf;

class Teach extends BaseController
{
    public function index() {
        $session = session();
        $model = new CourseModel();

        $teachingCourses = $model->getTeaching($session->get('user')); // return result array

        if($session->get('LoggedIn')) {
            echo view('template/header');
            echo view('components/teach');
            echo view('components/teach-list', ['teachingCourses' => $teachingCourses]);
            echo view('template/footer');
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function create_course_index() {

        if(session()->get('LoggedIn')) {
            echo view('template/header');
            echo view('create-course');
            echo view('template/footer');
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function create_course(){
        $session = session();
        $model = new CourseModel();
        $imgModel = new ImageModel();

        $rules = [
            'coursename'  => 'required|max_length[100]', 
            'description' => 'required|max_length[200]',
        ];
        if(!$this->validate($rules)) {
            echo view('template/header');
            echo view('create-course');
            echo view('template/footer');
        } else {
            $teacher = $session->get('user');
            $coursename = $this->request->getPost('coursename');
            $description = $this->request->getPost('description');
            $img = $this->request->getFile('img');

            $img->move(WRITEPATH . 'uploads/courses');
            $imgname = $img->getName();
            $imgname = $imgModel->crop_image($imgname);
            $success = $model->createCourse($teacher, $coursename, $description, $imgname);
            if ($success) {
                return redirect()->to('teach');
            } else {
                echo view('template/header');
                echo view('create-course');
                echo view('template/footer');
            }
        }
    }

    public function teach_item_index($id) {
        $courseModel = new CourseModel();
        // $uri = current_url(true);
        // $courseID = $uri->getSegment(5);
        $courseID = $id;
        $courseName = $courseModel->getCourseById($courseID)->coursename;
        $description = $courseModel->getCourseById($courseID)->description;
        $teacher = $courseModel->getCourseById($courseID)->teacher;
        $img = $courseModel->getCourseById($courseID)->img;
        $data = [
            'courseID' => $courseID,
            'courseName' => $courseName,
            'description' => $description,
            'teacher' => $teacher,
            'img' => $img
        ];

        // haldle multi file
        $lectures = $courseModel->getLectures($courseID);
        $data['lectures'] = $lectures;

        // handle reviews data retriving
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->getComments($courseID);
        $data['reviews'] = $reviews;

        if(session()->get('LoggedIn')) {
            echo view('template/header');
            echo view('teach-item', $data);
            echo view('template/footer');
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function updateCourse($courseID) {
        $courseModel = new CourseModel();
        $coursename = $this->request->getPost('coursename');
        $description = $this->request->getPost('description');
        $courseModel->updateCourse($courseID, $coursename, $description);
        return redirect()->back();
    }

    public function uploadFiles($courseID)
    {
        $courseModel = new CourseModel();
        $session = session();

        $teacher_id = $session->get('user');

        if ($file_arr = $this->request->getFiles()) {
            foreach ($file_arr['files'] as $file) {
                if ($file->isValid() && ! $file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH . 'uploads', $newName);
                    $courseModel->createLecture($courseID, $teacher_id, $newName);
                }
            }
            return redirect()->back()->with('toast', 'successfully uploaded');
        }
    }

    public function finish($courseID)
    {
        $session = session();
        $teacher_id = $session->get('user');
        $courseModel = new CourseModel();
        $userModel = new UserModel();
        $user = $userModel->getUserbyID($teacher_id);
        $data['firstname'] = $user->firstname;
        $data['lastname'] = $user->lastname;
        $data['coursename'] = $courseModel->getCourseById($courseID)->coursename;
        $firstname = $user->firstname;
        $lastname = $user->lastname;
        $coursename = $courseModel->getCourseById($courseID)->coursename;
        if ($teacher_id) {
            $html = '
            <html>
    <head>
        <style type="text/css">
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                font-size: 24px;
                text-align: center;
            }
            .container {
                border: 20px solid tan;
                width: 750px;
                height: 563px;
                vertical-align: middle;
            }
            .logo {
                color: tan;
            }

            .marquee {
                color: tan;
                font-size: 48px;
                margin: 20px;
            }
            .assignment {
                margin: 20px;
            }
            .person {
                border-bottom: 2px solid black;
                font-size: 32px;
                font-style: italic;
                margin: 20px auto;
                width: 400px;
            }
            .reason {
                font-size: 16px;
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">Coffee Sensation</div>

            <div class="marquee">
                Certificate of Instructor
            </div>

            <div class="assignment">
                This certificate is presented to
            </div>

            <div class="person">' . 
            $firstname. ' '. $lastname .'
            </div>

            <div class="reason">
                For teaching ' .  $coursename . 'on <br>
                Coffee Sensation - online learning platform
            </div>
        </div>
    </body>
</html>
            ';            
            
            
            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream();
            echo view('template/certificate', $data);

        }
        
    }
}
