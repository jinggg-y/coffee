<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\EmailController;

class Signup extends BaseController
{
    public function index()
    {

        if(session()->get('LoggedIn')) {
            $home = new Home();
            return $home->index();
        } else{
            echo view('template/header');
            echo view('signup');
            echo view('template/footer');
        }
    }

    public function register() {
        $rules = [
            'firstname' => 'required|max_length[10]|alpha',
            'lastname' => 'required|max_length[10]|alpha',
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[8]|max_length[30]|regex_match[/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/]',
        ];

        $userData = $this->request->getPost();

        $userModel = new UserModel();
        $emailController = new EmailController();

        // Check if the email is already taken
        if ($userModel->getUserbyEmail($userData['email'])) {
            // Email is already taken, display error message
            $session = session();
            $session->setFlashdata('error', 'The email is already exist.');
            return redirect()->back();
        }

        // Check against the rules 
        elseif(!$this->validate($rules)) {
            // $data['validation'] = $this->validator;
            // return redirect()->back();
            echo view('template/header');
            echo view('signup');
            echo view('template/footer');
        } 
        // Create user and send email verification
        else {
            $email_token = bin2hex(random_bytes(32));
            $emailController->sendVerification($email_token, $userData['email']);
            $userID = $userModel->createUser($userData['email'], $userData['password'], $userData['firstname'], $userData['lastname'], $email_token);
        }

        // auto login
        $session = session();
        $session->set('LoggedIn', true);
        $session->set('user', $userID);
        $session->set('email', $userData['email']);
        $session->set('firstname', $userData['firstname']);
        $session->set('lastname', $userData['lastname']);

        // Redirect to the home page
        return redirect()->to(base_url());
    }

    public function verifyEmail() {
        $token = $this->request->getVar('token');
        $userModel = new UserModel();
        $user = $userModel->getUserbyToken($token);
        if(!$user) {
            return redirect()->to(base_url().'invalid-verification');
        } else {
            $id = $user->id;
            $userModel->updateEmailVerification($id);
            return redirect()->to(base_url().'email-verified');
        }

    }

    public function emailVerified() {
        echo view('template/header');
        echo view('email-verified');
        echo view('template/footer');
        
    }

    public function invalidVerification() {
        echo view('template/header');
        echo view('invalid-verification');
        echo view('template/footer');
        
    }
}
