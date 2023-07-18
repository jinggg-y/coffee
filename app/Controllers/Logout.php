<?php

namespace App\Controllers;

class Logout extends BaseController
{
    public function index() {
        $data['error'] = "";
        echo view('template/header');
        echo view('template/footer');
    }

    public function logout() {
        $session = session();
        $session->set('LoggedIn', false);
        $session->destroy();
        setcookie('user', '', time() - 360000, "/");
        return redirect()->to(base_url('login'));
    }


}
