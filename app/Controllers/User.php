<?php

namespace App\Controllers;
use App\Libraries\Hash;
use CodeIgniter\CLI\Console;
use Config\Email;

class User extends BaseController
{
    public function __construct()
    {
        helper(['url','form','text']);
    }

    public function signIn()
    {
        $title = "Sign In";
        return view('users/sign-in',['validation' => \Config\Services::validation(),'title'=>$title]);
    }

    public function signUp()
    {
        $title = "Sign Up";
        return view('users/sign-up',['validation' => \Config\Services::validation(),'title'=>$title]);
    }

    public function resetPassword()
    {
        $title = "Forgot Password";
        return view('users/reset-password',['validation' => \Config\Services::validation(),'title'=>$title]);
    }

    public function profile()
    {
        $title = "Profile";
        $userModel = new \App\Models\userModel();
        $account = $userModel->find(session()->get('User'));
        $data = ['title'=>$title,'account'=>$account];
        return view('users/profile',$data);
    }

    //register
    public function registerUser()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'name'=>'required|is_unique[users.Fullname]',
            'email'=>'required|valid_email|is_unique[users.Email]',
            'password'=>'required|min_length[8]|max_length[16]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W]).+$/]',
            'confirm_password'=>'required|matches[password]',
            'agreement'=>'required'
        ]);
        if(!$validation)
        {
            return view('users/sign-up',['validation'=>$this->validator]);
        }
        else
        {
            $hash_password = Hash::make($this->request->getPost('password'));
            function generateRandomString($length = 64) {
                // Generate random bytes and convert them to hexadecimal
                $bytes = random_bytes($length);
                return substr(bin2hex($bytes), 0, $length);
            }
            $token_code = generateRandomString();
            //save
            $userModel = new \App\Models\userModel();
            $data = [
                    'Email'=>$this->request->getPost('email'), 
                    'Password'=>$hash_password,
                    'Fullname'=>$this->request->getPost('name'),
                    'Status'=>0,
                    'Token'=>$token_code,
                    'DateCreated'=>date('Y-m-d')
                    ];
            $userModel->save($data);
            //send email activation link
            $emailConfig = new Email();
            $fromEmail = $emailConfig->fromEmail;
            $fromName  = $emailConfig->fromName;
            $email = \Config\Services::email();
            $email->setTo($this->request->getPost('email'));
            $email->setFrom($fromEmail, $fromName); 
            $imgURL = "assets/images/logo.jpg";
            $email->attach($imgURL);
            $cid = $email->setAttachmentCID($imgURL);
            $template = "<center>
            <img src='cid:". $cid ."' width='100'/>
            <table style='padding:20px;background-color:#ffffff;' border='0'><tbody>
            <tr><td><center><h1>Account Activation</h1></center></td></tr>
            <tr><td><center>Hi, ".$this->request->getPost('name')."</center></td></tr>
            <tr><td><p><center>Please click the link below to activate your account.</center></p></td><tr>
            <tr><td><center><b>".anchor('activate/'.$token_code,'Activate Account')."</b></center></td></tr>
            <tr><td><p><center>If you did not sign-up in Digital Sports Hub Website,<br/> please ignore this message or contact us @ digitalsportshub@gmail.com</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "Account Activation | Digital Sports Hub";
            $email->setSubject($subject);
            $email->setMessage($template);
            $email->send();
            session()->setFlashdata('success','Great! Successfully sent activation link');
            return redirect()->to('success/'.$token_code)->withInput();
        }
    }   
    //login using email and password
    public function checkUser()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'email'=>'required|valid_email|is_not_unique[users.Email]',
            'password'=>'required|min_length[8]|max_length[16]|regex_match[/[A-Z]/]|regex_match[/[a-z]/]|regex_match[/[0-9]/]'
        ]);

        if(!$validation)
        {
            return view('users/sign-in',['validation'=>$this->validator]);
        }
        else
        {
            $userModel = new \App\Models\userModel();
            $user = $userModel->WHERE('Email',$this->request->getPost('email'))
                              ->WHERE('Status',1)->first();
            $checkPassword = Hash::check($this->request->getPost('password'),$user['Password']);
            if(empty($checkPassword)||!$checkPassword)
            {
                session()->setFlashdata("fail","Invalid Email or Password");
                return redirect()->to('sign-in')->withInput();
            }
            else
            {
                session()->set('User', $user['user_id']);
                session()->set('fullname', $user['Fullname']);
                session()->set('email',$user['Email']);
                session()->set('is_logged_in',true);
                return redirect()->to('/');
            }
        }
    }

    public function signOut()
    {
        if(session()->has('User'))
        {
            session()->remove('User');
            session()->destroy();
            return redirect()->to('/sign-in?access=out')->with('fail', 'You are logged out!');
        }
    }

    public function newPassword()
    {
        $validation = $this->validate([
            'csrf_sports'=>'required',
            'email'=>'required|valid_email|is_not_unique[users.Email]'
        ]);

        if(!$validation)
        {
            return view('users/reset-password',['validation'=>$this->validator]);
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

            $accountModel = new \App\Models\userModel();
            $account = $accountModel->WHERE('Email',$this->request->getPost('email'))->first();
            $data = ['Password'=>Hash::make($password)];
            $accountModel->update($account['user_id'],$data);
            //send the new password
            $emailConfig = new Email();
            $fromEmail = $emailConfig->fromEmail;
            $fromName  = $emailConfig->fromName;
            $email = \Config\Services::email();
            $email->setTo($account['Email']);
            $email->setFrom($fromEmail,$fromName);
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
            return redirect()->to('reset-password')->withInput();
        }
    }

    public function successLink($id)
    {
        $data = ['token'=>$id];
        return view('users/success-page',$data);
    }

    public function resend($id)
    {
        $userModel = new \App\Models\userModel();
        $user = $userModel->WHERE('Token',$id)->first();
        //send email activation link
        $emailConfig = new Email();
        $fromEmail = $emailConfig->fromEmail;
        $fromName  = $emailConfig->fromName;
        $email = \Config\Services::email();
        $email->setTo($user['Email']);
        $email->setFrom($fromEmail, $fromName); 
        $imgURL = "assets/images/logo.jpg";
        $email->attach($imgURL);
        $cid = $email->setAttachmentCID($imgURL);
        $template = "<center>
        <img src='cid:". $cid ."' width='100'/>
        <table style='padding:20px;background-color:#ffffff;' border='0'><tbody>
        <tr><td><center><h1>Account Activation</h1></center></td></tr>
        <tr><td><center>Hi, ".$user['Fullname']."</center></td></tr>
        <tr><td><p><center>Please click the link below to activate your account.</center></p></td><tr>
        <tr><td><center><b>".anchor('activate/'.$id,'Activate Account')."</b></center></td></tr>
        <tr><td><p><center>If you did not sign-up in Digital Sports Hub Website,<br/> please ignore this message or contact us @ digitalsportshub@gmail.com</center></p></td></tr>
        <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
        $subject = "Account Activation | Digital Sports Hub";
        $email->setSubject($subject);
        $email->setMessage($template);
        $email->send();
        session()->setFlashdata('success','Great! Successfully sent activation link');
        return redirect()->to('success/'.$id)->withInput();
    }

    public function activateAccount($id)
    {
        $userModel = new \App\Models\userModel();
        $user = $userModel->WHERE('Token',$id)->first();
        $values = ['Status'=>1];
        $userModel->update($user['user_id'],$values);
        session()->set('User', $user['user_id']);
        session()->set('fullname', $user['Fullname']);
        return $this->response->redirect(site_url('/'));
    }

    public function accountSecurity()
    {
        $validation = $this->validate([
            'current_password'=>[
                'rules' => 'required|min_length[8]|max_length[16]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W]).+$/]',
                'errors' => [
                    'required' => 'Current Password is required.',
                    'min_length' => 'Password must be at least 8 characters long.',
                    'max_length' => 'Password must not exceed 16 characters.',
                    'regex_match' => 'Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character.',
                ],
            ],
            'new_password'=>[
                'rules' => 'required|min_length[8]|max_length[16]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W]).+$/]',
                'errors' => [
                    'required' => 'New Password is required.',
                    'min_length' => 'Password must be at least 8 characters long.',
                    'max_length' => 'Password must not exceed 16 characters.',
                    'regex_match' => 'Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character.',
                ],
            ],
            'confirm_password'=>[
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Confirm Password is required.',
                    'matches' => 'Passwords do not match.',
                ],
            ]
        ]);

        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $userModel = new \App\Models\userModel();
            $user = $userModel->WHERE('user_id',session()->get('User'))->first();
            $checkPassword = Hash::check($this->request->getPost('current_password'),$user['Password']);
            if(!$checkPassword)
            {
                $errorMessage = ['current_password'=>'Invalid Password. Please try again'];
                return $this->response->setJSON(['error'=>$errorMessage]);
            }
            else
            {
                $data = ['Password'=>Hash::make($this->request->getPost('new_password'))];
                $userModel->update($user['user_id'],$data);
                return $this->response->setJSON(['success' => 'Successfully applied changes']);
            }
        }
    }
}