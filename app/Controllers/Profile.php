<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{

    public function index() {
        $session = session();
        if($session->get('LoggedIn')){

            $model = new UserModel();

            $userid = $session->get('user');
            $user = $model->getUserbyID($userid);

            $firstname =  $user->firstname;
            $lastname =  $user->lastname;
            $email =  $user->email;
            $mobile =  $user->mobile;

            $data = [
                'email'       => $email,
                'mobile'       => $mobile,
                'firstname'   => $firstname,
                'lastname'    => $lastname,
            ];
    
            echo view('template/header');
            echo view('profile', $data);
            echo view('template/footer');
        } else {
            return redirect()->to(base_url("login"))->with('toast', 'Please log in first');
        }
    }
    
    public function savedata() {
        $session = session();
        $model = new UserModel();

        $id = $session->get('user');

        $email = $this->request->getPost('email');
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');
        $mobile = $this->request->getPost('mobile');
       
        $model->updateUser($id, $email, $mobile, $firstname, $lastname);
        return redirect()->back()->with('toast','Profile successfully updated');
    }

    public function addToWishlist($courseID)
    {
        $uid = session()->get('user');
        $userModel = new UserModel();
        if($uid) {
            $userModel->addToWishlist($uid, $courseID);
            return redirect()->back()->with('toast', 'Successfully added to wishlist');
        } else {
            return redirect()->back()->with('toast', 'You must log in first');
        }
    }

    public function getWishlist()
    {
        $uid = session()->get('user');
        $userModel = new UserModel();
        if($uid) {
            $data['courses'] = $userModel->getWishlist($uid);
            echo view('template/header');
            echo view('wishlist', $data);
            echo view('template/footer');
        } else {
            return redirect()->back()->with('toast', 'You must log in first');
        }
    }

    public function deleteWishlistItem($courseID)
    {
        $uid = session()->get('user');
        $userModel = new UserModel();
        if($uid) {
            $userModel->deleteWishlistItem($uid, $courseID);
            return redirect()->back();
        }
    }
}