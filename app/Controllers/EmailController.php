<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class EmailController extends Controller
{

    public function sendVerification($token, $to) {
        $email = new Email();

        $emailConf = [
            'protocol' => 'smtp',
            'wordWrap' => true,
            'SMTPHost' => 'mailhub.eait.uq.edu.au',
            'SMTPPort' => 25
        ];
        $email->initialize($emailConf);

        // 32 alphanumeric characters long and unique token

        $from = 'jing.yang3@uqconnect.edu.au';
        $fromName = 'Coffee Sensation';
        $subject = 'Verify Email';
        $message = "Thank you for signing up. Please click the link below to verify your email:\n\n";
        $message .= base_url() . "verify-email?token=" . $token;

        $email->setFrom($from, $fromName);
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        if (!$email->send()) {
            echo "Oops, can't send email";
            // throw new \Exception('Error sending email: ' . $email->printDebugger());
        }
    }

    public function sendPassReset($token, $to) {
        $email = new Email();

        $emailConf = [
            'protocol' => 'smtp',
            'wordWrap' => true,
            'SMTPHost' => 'mailhub.eait.uq.edu.au',
            'SMTPPort' => 25
        ];
        $email->initialize($emailConf);

        // 32 alphanumeric characters long and unique token

        $from = 'jing.yang3@uqconnect.edu.au';
        $fromName = 'Coffee Sensation';
        $subject = 'Reset Password';
        $message = "Here is your password reset link:\n\n";
        $message .= base_url() . "reset-password?token=" . $token;

        $email->setFrom($from, $fromName);
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        if (!$email->send()) {
            throw new \Exception('Error sending email: ' . $email->printDebugger());
        }
    }

}

