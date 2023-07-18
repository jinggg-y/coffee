<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\ImageModel;
use App\Models\ReviewModel;
use App\Models\UserModel;

class Course extends BaseController
{
    public function course_item_index($courseID) {
        $courseModel = new CourseModel();
        $userModel = new UserModel();
        
        $courseName = $courseModel->getCourseById($courseID)->coursename;
        $description = $courseModel->getCourseById($courseID)->description;
        $teacherID = $courseModel->getCourseById($courseID)->teacher;
        $teacher = $userModel->getUserbyID($teacherID);
        $firstName = $teacher->firstname;
        $lastName = $teacher->lastname;
        $img = $courseModel->getCourseById($courseID)->img;
        $data = [
            'courseID' => $courseID,
            'courseName' => $courseName,
            'description' => $description,
            'teacher' => $firstName . " ". $lastName,
            'img' => $img
        ];

        $lectures = $courseModel->getLectures($courseID);
        $data['lectures'] = $lectures;

        // handle reviews data retriving
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->getComments($courseID);
        $data['reviews'] = $reviews;
        
            echo view('template/header');
            echo view('content', $data);
            echo view('template/footer');
    }
    public function comment($courseID) {
        $session = session();
        $reviewModel = new ReviewModel();
        $uid = $session->get('user');
        if($uid) {
            $rating = $this->request->getPost('rating');
            $comment = $this->request->getPost('comment');
            $reviewModel->createComment($uid, $courseID, $rating, $comment);
            return redirect()->back();
        } else {
            return redirect()->back()->with('toast', 'You must log in first');
        }
        
    }
}