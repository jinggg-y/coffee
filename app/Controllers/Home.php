<?php

namespace App\Controllers;
use App\Models\CourseModel;

class Home extends BaseController
{
    public function index() {
        $model = new CourseModel();
        $courses = $model->getAllCourse();

        $data['error'] = "";
        $data['courses'] = $courses;
        $data['start'] = 0;

        echo view('template/header');
        echo view('home');
        echo view('components/courses_home', $data);
        echo view('template/footer');
    }

    public function AJAXLoad()
    {   
        $request = $this->request;
        $session = session();      
        if($request->isAJAX()){        
            $model = new CourseModel();
            $courses = $model->getAllCourse();

            $data['error'] = "";
            $data['courses'] = $courses;
            $data['start'] = (int) $request->getPost('start');

            header('Content-Type: application/json');
            echo json_encode($data);          
        }        
    }

    public function search()
    {
        $courseModel  = new CourseModel();
        $keyword = $this->request->getGet('keyword');
        $results = $courseModel->search($keyword);
        $data['results'] = $results;

        echo view('template/header');
        echo view('search-results', $data);
        echo view('template/footer');
    }

}
