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
}