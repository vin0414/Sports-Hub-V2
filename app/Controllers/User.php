<?php

namespace App\Controllers;
use App\Libraries\Hash;

class User extends BaseController
{
    public function __construct()
    {
        helper(['url','form','text']);
    }

    public function signIn()
    {
        $title = "Sign In";
        $data = ['title'=>$title];
        return view('users/sign-in',$data);
    }

    public function signUp()
    {
        $title = "Sign Up";
        $data = ['title'=>$title];
        return view('users/sign-up',$data);
    }
}