<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Controllers\EmailController;

class Login extends BaseController
{
    public function index() {
        $data['error']= "";

        $session = session();
        if (!isset($_COOKIE['user'])){
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }else{
            $session = session();
            $email = $session->get('user');
            return redirect()->to(base_url());  
        }
    }

    public function checklogin() {
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remembered = $this->request->getPost('remember');
        $userModel = new UserModel();
        $user  = $userModel->getUserbyEmail($email);
        if ($user && password_verify($password, $user->password)) {
            $id = $user->id;
            $session = session();
            $session->set('user', $id);            
            $session->set('email', $email);            
            $session->set('LoggedIn', true);
            if ($remembered) {
                setcookie('user', $id, time()+(864000*30), "/");
            }
            return redirect()->to(base_url());  
       }
       else{
        $session = session();
        $session->setFlashdata('error', 'Invalid email or password');
        return redirect()->back();
        }
    }

    public function index_forgotpassword() {
        $data['error']= "";

        $session = session();
        if (!$session->get('LoggedIn')){
            echo view('template/header');
            echo view('forgot-password', $data);
            echo view('template/footer');
        }else{
            $session = session();
            $email = $session->get('user');
            return redirect()->to(base_url());  
        }
    }

    public function email_forgotpassword() {
        $emailController = new EmailController();
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $token = $userModel->updatePassToken($email);
        $emailController->sendPassReset($token, $email);
        echo "Please check your email";
    }

    public function index_resetPassword() {
        $token = $this->request->getVar('token');
        $data['token'] = $token;
        $userModel = new UserModel();
        $user = $userModel->getUserbyPassToken($token);
        if(!$user) {
            return redirect()->to(base_url().'invalid-reset');
        } else {
            echo view('template/header');
            echo view('reset-password', $data);
            echo view('template/footer');
        }
    }

    public function resetPassword() {
        $newpassword = $this->request->getPost('newpassword');
        $retypepassword = $this->request->getPost('retypepassword');

        // echo '<script>console.log(1);</script>';

        $token = $this->request->getGet('token');
        $userModel = new UserModel();
        $user = $userModel->getUserbyPassToken($token);
        $id = $user['id'];

        $rules = [
            'newpassword'  => 'required|min_length[8]|max_length[30]|regex_match[/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/]',
            'retypepassword' => 'required|matches[newpassword]'
        ];
        if (!$this->validate($rules)) {
            echo validation_list_errors();
        } else {
            $hashed_password = password_hash($newpassword, PASSWORD_BCRYPT);
            $userModel->updatePassword($id, $hashed_password);
            return redirect()->to(base_url());
        }

    }

    public function invalid_reset() {
        echo view('template/header');
        echo view('invalid-reset');
        echo view('template/footer');
    }

}