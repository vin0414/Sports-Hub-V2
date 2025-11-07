<?php

namespace App\Controllers;
use App\Libraries\Hash;
use Config\Email;
use DateTime;

class User extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
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
                session()->set('user_fullname', $user['Fullname']);
                session()->set('user_email',$user['Email']);
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
        session()->set('user_fullname', $user['Fullname']);
        session()->set('user_email', $user['Email']);
        session()->set('is_logged_in',true);
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

    public function join()
    {
        $data['title']='Join';
        $data['validation'] = \Config\Services::validation();
        return view('users/join',$data);
    }

    public function submitForm()
    {
        $model = new \App\Models\registerModel();
        $validation = $this->validate([
            'user'=>[
                'rules'=>'required|numeric',
                'errors'=>[
                    'required'=>'User ID is required',
                ]
            ],
            'application'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Please select role'
                    ]
            ],
            'phone'=>['rules'=>'required|numeric',
                      'errors'=>[
                        'required'=>'Enter contact number',
                        'numeric'=>'Enter valid number'
                                ]
                     ],
            'address'=>[
                'rules'=>'required',
                'errors'=>['required'=>'Enter complete address']
            ],
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,10240]|mime_in[file,application/pdf,application/zip]',
                'errors' => [
                    'uploaded' => 'Attachment is required.',
                    'max_size' => 'The file must not exceed 10MB.',
                    'mime_in' => 'Only PDF and ZIP formats are allowed.'
                ]
            ],
            'agreement'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'You must agree to the terms and conditions to proceed.'
                ]
            ],

        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            //check the age based on the date
            $birthDate = new DateTime($this->request->getPost('birth_date'));
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthDate);
            if($age->y<18)
            {
                $errors = ['birth_date'=>'Invalid! You must be 18 years or older to join.'];
                return $this->response->setJSON(['errors'=>$errors]);
            }  
            else
            {
                $application = $this->request->getPost('application');
                $height = $this->request->getPost('height');
                $weight = $this->request->getPost('weight');
                if($application==="Player" && (empty($height) || empty($weight)))
                {
                    $errors = ['height'=>'Height is required','weight'=>'Weight is required'];
                    return $this->response->setJSON(['errors'=>$errors]);
                }

                $file = $this->request->getFile('file');
                $originalName = date('YmdHis').$file->getClientName();
                // Define the target directory
                $targetDir = 'assets/files/';
                // Create the directory if it doesn't exist
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true); // 0755 permissions, recursive creation
                }
                // Move the uploaded file
                $file->move($targetDir, $originalName);
                $status=0;
                if($application==="Player")
                {
                    $status=1;
                }
                else
                {
                    $status=0;
                }
                $data = [
                        'application_type'=>$this->request->getPost('application'),
                        'user_id'=>session()->get('User'),
                        'fullname'=>session()->get('user_fullname'),
                        'email'=>session()->get('user_email'),
                        'phone'=>$this->request->getPost('phone'),
                        'birth_date'=>$this->request->getPost('birth_date'),
                        'address'=>$this->request->getPost('address'),
                        'height'=>$height,
                        'weight'=>$weight,
                        'desired_position'=>$this->request->getPost('position'),
                        'status'=>$status,
                        'remarks'=>'',
                        'file'=>$originalName,
                        'datecreated'=>date('Y-m-d'),
                        'agreement'=>$this->request->getPost('agreement')
                    ];
                $model->save($data);
                return $this->response->setJSON(['success'=>'Successfully submitted']);
            }
        }
    }

    public function searchTeam()
    {
        $data['title']="Search a Team";
        $model = new \App\Models\sportsModel();
        $data['category']=$model->findAll();
        //team
        $cat = $this->request->getGet('category');
        $team = new \App\Models\teamModel();
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 6;

        // Build query
        if ($cat) {
            if ($cat) $team->whereIn('sportsID', (array)$cat);
        }
        $team->where('status', 1)->orderBy('team_id', 'DESC');
        $list = $team->paginate($perPage, 'default', $page);
        $total = $team->where('status',1)->countAllResults();       
        $pager = $team->pager;
        $data['team']=$list;
        $data['page']=$page;
        $data['perPage']=$perPage;
        $data['total']=$total;
        $data['pager']=$pager;
        return view('users/search-team',$data);
    }

    public function teamInfo()
    {
        $val = $this->request->getGet('value');
        $output='';
        if(!is_numeric($val))
        {
            echo "Invalid! Please try again";
        }
        else
        {
            $teamModel = new \App\Models\teamModel();
            $team = $teamModel->where('team_id',$val)->first();
            //get the total stats
            $statModel = $this->db->table('team_stats')
                    ->select('SUM(wins)wins,SUM(losses)loss,SUM(draws)draw')
                    ->where('team_id',$val)->groupBy('team_id');
            $stats = $statModel->get()->getRow();

            $output.='<div class="row g-2">
                        <div class="col-lg-8">
                            <div class="row g-1">
                                <div class="col-lg-12">Team : '.$team['team_name'].'</div>
                                <div class="col-lg-12">School/University/Brgy : '.$team['school_barangay'].'</div>
                                <div class="col-lg-12">Organization : '.$team['organization'].'</div>
                                <div class="col-lg-12 mb-1">Coach : '.$team['coach_name'].'</div>
                                <div class="col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title">Wins</div>
                                                    <h1><center>'.($stats->wins ?? 0).'</center></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title">Losses</div>
                                                    <h1><center>'.($stats->loss ?? 0).'</center></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title">Draws</div>
                                                    <h1><center>'.($stats->draw ?? 0).'</center></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <img src="/assets/images/team/'.$team['image'].'" style="border-radius: 5px 5px;height:200px;width:250px;"/>
                        </div>
                    </div>
                     ';
            echo $output;
        }
    }

    public function me($id)
    {
        $data['title']="Personal Information";
        //team
        $teamModel = new \App\Models\teamModel();
        $team = $teamModel->where('team_name',$id)->first();
        $data['team']=$team;
        //team stats
        $stats = $this->db->table('team_stats')
            ->select('SUM(wins) AS win, SUM(losses) AS loss')
            ->where('team_id', $team['team_id'])
            ->groupBy('team_id')
            ->get()
            ->getRow();
        $data['stats'] = $stats;

        //player performance
        $playerModel = new \App\Models\playerModel();
        $player = $playerModel->where('user_id',session()->get('User'))
                              ->where('team_id',$team['team_id'])
                              ->first();
        $data['player']=$player;
        $performanceModel = new \App\Models\performanceModel();
        $performance = $performanceModel->where('player_id',$player['player_id'])
                       ->where('team_id',$team['team_id'])
                       ->groupBy('stat_type')->findAll();
        $data['performance']=$performance;
        //role
        $roleModel = new \App\Models\roleModel();
        $role = $roleModel->where('roleID',$player['roleID'])->first();
        $data['role']=$role;
                       
        return view('users/player-team',$data);
    }

    public function meEdit($id)
    {
        $data['title']='Edit Profile';
        $playerModel = new \App\Models\playerModel();
        $data['player'] = $playerModel->where('player_id',$id)->first();
        return view('users/edit-profile',$data);
    }

    public function createTeam()
    {
        $data['title']="Create a Team";
        $model = new \App\Models\sportsModel();
        $data['category']=$model->findAll();
        return view('users/create-team',$data);
    }

    public function teamRegistration()
    {
        $model = new \App\Models\teamModel();
        $staff = new \App\Models\staffModel();
        $validation = $this->validate([
            'team_name'=>[
                'rules'=>'required|is_unique[teams.team_name]',
                'errors'=>[
                    'required'=>'Name of team is required',
                    'is_unique'=>'Name of team is already exist. Please try again'
                ]
            ],
            'sport'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Select sport'
                ]
            ],
            'category'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Select category'
                ]
            ],
            'organization'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Name of organization is required'
                ]
            ],
            'school_barangay'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Enter name of school or barangay'
                ]
            ],
            'file'=>[
                'rules'=>'uploaded[file]|max_size[file,2048]|is_image[file]|mime_in[file,image/png,image/jpeg,image/jpg]',
                'errors'=>[
                    'uploaded' => 'Team logo or image is required.',
                    'max_size' => 'The image must not exceed 2MB.',
                    'is_image' => 'The uploaded file must be an image.',
                    'mime_in' => 'Only PNG and JPEG formats are allowed.'
                ]
            ],
            'agreement'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'You must agree to the terms and conditions to proceed.'
                ]
            ],
        ]);

        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {

            $name = array_map('strip_tags', $this->request->getPost('name'));
            $email = array_map('strip_tags', $this->request->getPost('email'));
            $position = array_map('strip_tags', $this->request->getPost('position'));
            $errors = [];

            for ($i = 0; $i < count($name); $i++) {
                if (empty($name[$i])) {
                    $errors["name_$i"] = "Staff name is required.";
                }
                if (empty($email[$i])) {
                    $errors["email_$i"] = "Staff email is required.";
                } elseif (!filter_var($email[$i], FILTER_VALIDATE_EMAIL)) {
                    $errors["email_$i"] = "Staff email is invalid.";
                }
                if (empty($position[$i])) {
                    $errors["position_$i"] = "Staff position is required.";
                }
            }
            if(!empty($errors))
            {
                return $this->response->setJSON(['error'=>$errors]);
            }
            else
            {
                $file = $this->request->getFile('file');
                $originalName = date('YmdHis').$file->getClientName();
                // Define the target directory
                $targetDir = 'assets/images/team/';
                // Create the directory if it doesn't exist
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true); // 0755 permissions, recursive creation
                }
                // Move the uploaded file
                $file->move($targetDir, $originalName);
                $data = [
                        'team_name'=>$this->request->getPost('team_name'),
                        'coordinator'=>session()->get('user_fullname'),
                        'user_id'=>session()->get('User'),
                        'sportsID'=>$this->request->getPost('sport'),
                        'category'=>$this->request->getPost('category'),
                        'school_barangay'=>$this->request->getPost('school_barangay'),
                        'image'=>$originalName,
                        'organization'=>$this->request->getPost('organization'),
                        'remarks'=>'OPEN',
                        'status'=>0
                    ];
                $model->save($data);
                $team_id = $model->insertID();
                //save the staff info
                for ($i = 0; $i < count($name); $i++) 
                {
                    $data = [
                        'team_id'=>$team_id,
                        'name'=>$name[$i],
                        'position'=>$position[$i],
                        'email'=>$email[$i],
                        'status'=>1,
                        'user_id'=>session()->get('User')
                    ];
                    $staff->save($data);
                }
                
                return $this->response->SetJSON(['success'=>'Successfully submitted']);
            }
        }
    }

    public function myTeam($id)
    {
        $data['title']="My Team";
        //load the team data
        $model = new \App\Models\teamModel();
        $team=$model->where('team_name',$id)->first();
        $data['team'] = $team;
        $staff = new \App\Models\staffModel();
        $data['staff'] = $staff->where('team_id',$team['team_id'])->findAll();
        return view('users/my-team',$data);
    }

    public function editPlayer($id)
    {
        if(!is_numeric($id))
        {
            return redirect()->back();
        }
        $model = new \App\Models\playerModel();
        $player = $model->where('player_id',$id)->first();
        //get the registratio
        $registerModel = new \App\Models\registerModel();
        $registration = $registerModel->where('user_id',$player['user_id'])->first();
        //types of sports
        $sportsModel = new \App\Models\sportsModel();
        $sports = $sportsModel->where('sportsID',$player['sportsID'])->first();
        //get the roles
        $roleModel = new \App\Models\roleModel();
        $roles = $roleModel->where('sportsName',$sports['Name'])->findAll();
        //display the page
        $data = ['title'=>'Edit Player','player'=>$player,'registration'=>$registration,'roles'=>$roles];
        return view('users/edit-player',$data);
    }

    public function subscribe()
    {
        $data['title']="Subscribe";
        return view('users/subscribe',$data);
    }

    public function donate()
    {
        $data['title']="Donate";
        return view('users/donate',$data);
    }

    public function processing()
    {
        $subscribeModel = new \App\Models\subscribeModel();
        $data = [
            'user_id'=>session()->get('User'),
            'reference'=>'',
            'amount'=>0,
        ];
        $subscribeModel->save($data);
        return $this->response->setJSON(['success'=>'Successfully subscribed']);
    }

    public function sendDonation()
    {
        $subscribeModel = new \App\Models\subscribeModel();
        $validation = $this->validate([
            'amount'=>[
                'rules'=>'required|numeric|min_length[2]',
                'errors'=>[
                    'required'=>'Enter donation amount',
                    'numeric'=>'Enter valid amount',
                    'min_length'=>'Minimum amount is 10'
                ]
            ],
            'reference'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Transaction reference is required'
                ]
            ]
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['errors' => 'Invalid input. Please check and try again.']);
        }
        else
        {
            $subscribe = $subscribeModel->where('user_id',session()->get('User'))->first();
            $data = [
                'reference'=>$this->request->getPost('reference'),
                'amount'=>$this->request->getPost('amount')
            ];
            $subscribeModel->update($subscribe['subscribe_id'],$data);
            return $this->response->setJSON(['success'=>'Thank you for your donation!']);
        } 
    }
}