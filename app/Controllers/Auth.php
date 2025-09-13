<?php

namespace App\Controllers;
use App\Libraries\Hash;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url','form','text']);
    }
    public function checkAuth()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'email'=>[
                'rules' => 'required|valid_email|is_not_unique[accounts.email]',
                'errors' => [
                            'required' => 'Email is required.',
                            'valid_email' => 'Please enter a valid email address.',
                            'is_not_unique' => 'This email is not registered. Please use a different email.',
                        ],
                    ],
            'password'=>[
                'rules' => 'required|min_length[8]|max_length[16]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W]).+$/]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 8 characters long.',
                    'max_length' => 'Password must not exceed 16 characters.',
                    'regex_match' => 'Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character.',
                ],
            ]
        ]);
        if(!$validation)
        {
            return view('auth/login',['validation'=>$this->validator]);
        }
        else
        {
            $accountModel = model('App\Models\AccountModel');
            $account = $accountModel->where('Email', $this->request->getPost('email'))->first();
            if($account && Hash::check($this->request->getPost('password'), $account['Password']))
            {
                session()->set('is_logged_in', true);
                session()->set('loggedUser', $account['accountID']);
                session()->set('email', $account['Email']);
                session()->set('fullname', $account['Fullname']);
                session()->set('role', $account['Role']);
                //logs
                $logModel = model('App\Models\logModel');
                $logData = [
                        'date'=> date('Y-m-d H:i:s'),
                        'accountID'=> $account['accountID'],
                        'activities'=> 'Logged In',
                        'page'=> 'Login Page'
                    ];;
                $logModel->insert($logData);
                return redirect()->to(base_url('dashboard'));
            }
            else
            {
                session()->setFlashdata('error', 'Invalid email or password.');
                return redirect()->back();
            }   
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth'));
    }

    public function requestNewPassword()
    {
        $validation = $this->validate([
            'csrf_test_name'=>'required',
            'email'=>'required|valid_email|is_not_unique[accounts.Email]'
        ]);

        if(!$validation)
        {
            return view('auth/forgot-password',['validation'=>$this->validator]);
        }
        else
        {
            function generatePassword($length = 16) {
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?';
                $password = '';
                $maxIndex = strlen($chars) - 1;

                for ($i = 0; $i < $length; $i++) {
                    $password .= $chars[random_int(0, $maxIndex)];
                }

                return $password;
            }

            $password = generatePassword(16);

            $accountModel = new \App\Models\AccountModel();
            $account = $accountModel->WHERE('Email',$this->request->getPost('email'))->first();
            $data = ['Password'=>Hash::make($password)];
            $accountModel->update($account['accountID'],$data);
            //send the new password
            $email = \Config\Services::email();
            $email->setTo($account['Email']);
            $email->setFrom("vinmogate@gmail.com","Digital Sports Hub");
            $imgURL = "assets/images/logo.jpg";
            $email->attach($imgURL);
            $cid = $email->setAttachmentCID($imgURL);
            $template = "<center>
            <img src='cid:". $cid ."' width='100'/>
            <table style='padding:20px;background-color:#ffffff;' border='0'><tbody>
            <tr><td><center><h1>New Password</h1></center></td></tr>
            <tr><td><center>Hi, ".$account['Fullname']."</center></td></tr>
            <tr><td><p><center>We hope this email finds you well. This message is to inform you that your password has been successfully reset. Your new password is: </center></p></td><tr>
            <tr><td><center><b>".$password."</b></center></td></tr>
            <tr><td><p><center>For security purposes, we strongly advise you to change this password once you log in to our website.</center></p></td></tr>
            <tr><td><p><center>If you did not request in Digital Sports Hub Website,<br/> please ignore this message or contact us @ digitalsportshub@gmail.com</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "New Password | Digital Sports Hub";
            $email->setSubject($subject);
            $email->setMessage($template);
            $email->send();
            session()->setFlashdata('success','Great! Your new password was sent to your email');
            return redirect()->to('forgot-password')->withInput();
        }
    }
}