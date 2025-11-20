<?php

namespace App\Controllers;
use Config\App;
use \App\Models\registerModel;
use \App\Models\teamModel;
use \App\Models\playerModel;
use \App\Models\scheduleModel;
use \App\Models\matchModel;
use \App\Models\performanceModel;
use \App\Models\userModel;
use Config\Email;

class Roster extends BaseController
{
    private $db;
    public function __construct()
    {
        helper(['url','form','text']);
        $this->db = \Config\Database::connect();
    }
    public function getPendingList()
    {
        if(empty(session()->get('loggedUser')))
        {
            return redirect()->back();
        }
        $registerModel = new registerModel();
        $pending = $registerModel->where('status',0)->where('application_type','Organization')->findAll();
        return response()->setJSON(body: ['pending'=>$pending]);
    }

    public function getApproveList()
    {
        if(empty(session()->get('loggedUser')))
        {
            return redirect()->back();
        }
        $registerModel = new registerModel();
        $approve = $registerModel->where('status',1)->where('application_type','Organization')->findAll();
        return response()->setJSON(body: ['approve'=>$approve]);
    }

    public function fetchTeam()
    {
        if(empty(session()->get('loggedUser')))
        {
            return redirect()->back();
        }
        $teamModel = new teamModel();
        $team = $teamModel->where('status',0)->findAll();
        return response()->setJSON(['team'=>$team]);
    }

    public function teamVerify()
    {
       $val = $this->request->getPost('value');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {   
            $teamModel = new teamModel();
            $data = ['status'=>1];
            $teamModel->update($val,$data);
            //get the contact email
            $team = $teamModel->where('team_id',$val)->first();
            $userModel = new userModel();
            $user = $userModel->where('user_id',$team['user_id'])->first();
            //send email
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
            <tr><td><center><h1>Digital Sports Hub</h1></center></td></tr>
            <tr><td><center>Hi, ".$user['Fullname']."</center></td></tr>
            <tr><td><p><center>Your registered team has been approved. Please check your account to verify the details.</center></p></td><tr>
            <tr><td><p><center>If you did not sign-up in Digital Sports Hub Website,<br/> please ignore this message or contact us @ digitalsportshub@gmail.com</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "Approved Registration | Digital Sports Hub";
            $email->setSubject($subject);
            $email->setMessage($template);
            $email->send();
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function teamReject()
    {
       $val = $this->request->getPost('value');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {   
            $teamModel = new teamModel();
            $data = ['status'=>2];
            $teamModel->update($val,$data);
            //get the contact email
            $team = $teamModel->where('team_id',$val)->first();
            $userModel = new userModel();
            $user = $userModel->where('user_id',$team['user_id'])->first();
            //send email
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
            <tr><td><center><h1>Digital Sports Hub</h1></center></td></tr>
            <tr><td><center>Hi, ".$user['Fullname']."</center></td></tr>
            <tr><td><p><center>Your registered team has been declined. Please check your account to verify the details.</center></p></td><tr>
            <tr><td><p><center>If you did not sign-up in Digital Sports Hub Website,<br/> please ignore this message or contact us @ digitalsportshub@gmail.com</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "Declined Registration | Digital Sports Hub";
            $email->setSubject($subject);
            $email->setMessage($template);
            $email->send();
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function confirmation()
    {
        $val = $this->request->getPost('value');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {   
            $registerModel = new registerModel();
            $data = ['status'=>1,'remarks'=>'Registered'];
            $registerModel->update($val,$data);
            //get the contact email
            $register = $registerModel->where('register_id',$val)->first();
            $userModel = new userModel();
            $user = $userModel->where('user_id',$register['user_id'])->first();
            //send email
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
            <tr><td><center><h1>Digital Sports Hub</h1></center></td></tr>
            <tr><td><center>Hi, ".$user['Fullname']."</center></td></tr>
            <tr><td><p><center>Your account registration has been approved. Please check your account to verify the details.</center></p></td><tr>
            <tr><td><p><center>If you did not sign-up in Digital Sports Hub Website,<br/> please ignore this message or contact us @ digitalsportshub@gmail.com</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "Account Registration | Digital Sports Hub";
            $email->setSubject($subject);
            $email->setMessage($template);
            $email->send();
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function reject()
    {
        $val = $this->request->getPost('value');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {   
            $registerModel = new registerModel();
            $data = ['status'=>2,'remarks'=>'Rejected'];
            $registerModel->update($val,$data);
            //get the contact email
            $register = $registerModel->where('register_id',$val)->first();
            $userModel = new userModel();
            $user = $userModel->where('user_id',$register['user_id'])->first();
            //send email
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
            <tr><td><center><h1>Digital Sports Hub</h1></center></td></tr>
            <tr><td><center>Hi, ".$user['Fullname']."</center></td></tr>
            <tr><td><p><center>Your account registration has been declined. Please check your account to verify the details.</center></p></td><tr>
            <tr><td><p><center>If you did not sign-up in Digital Sports Hub Website,<br/> please ignore this message or contact us @ digitalsportshub@gmail.com</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "Account Registration | Digital Sports Hub";
            $email->setSubject($subject);
            $email->setMessage($template);
            $email->send();

            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function joinTeam()
    {
        $model = new playerModel();
        $teamModel = new teamModel();
        $val = $this->request->getPost('value');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {
            //get the info from registration
            $registerModel = new registerModel();
            $register = $registerModel->where('user_id',session()->get('User'))->first();
            //get the team id and category
            $team = $teamModel->where('team_id',$val)->first();
            //check if the user already joined a team
            $checkUser = $model->where('user_id',session()->get('User'))
                                        ->where('team_id !=',0)
                                        ->where('sportsID',$team['sportsID'])->first();
            if(empty($checkUser))
            {
                $data = [
                    'team_id'=>$val,
                    'user_id'=>session()->get('User'),
                    'date_of_birth'=>$register['birth_date'],
                    'sportsID'=>$team['sportsID'],
                    'roleID'=>0,
                    'jersey_num'=>0,
                    'gender'=>'Male',
                    'email'=>session()->get('user_email'),
                    'height'=>$register['height'],
                    'weight'=>$register['weight'],
                    'address'=>$register['address'],
                    'image'=>'',
                    'status'=>0
                ];
                $model->save($data);
                return response()->setJSON(['success'=>'Successfully submitted']);
            }
            else
            {
                echo "Invalid! You are already joined in a team. Please select other sports category";
            }
        }
    }

    public function playerList()
    {
        $val = $this->request->getGet('teamId');
        //get the list of players
        $data = $this->db->table('players as a')
                ->select('a.*,b.Fullname,c.roleName')
                ->join('registration as b','b.user_id=a.user_id','LEFT')
                ->join('player_role as c','c.roleID=a.roleID','LEFT')
                ->where('a.team_id',$val)
                ->whereIN('a.status',[1,2]);
        $players = $data->get()->getResult();
        return response()->setJSON(['players'=>$players]);
    }

    public function editPlayerInfo()
    {
        $model = new playerModel();
        $validation = $this->validate([
            'email' => 'required|valid_email',
            'birth_date' => 'required|valid_date',
            'position' => 'required|numeric',
            'order'=>'required|numeric',
            'jersey_number' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'status' => 'required|numeric',
            'image' => [
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg,image/png]',
                'max_size[image,2048]',
            ]
        ]);
        if(!$validation)
        {
            return response()->setJSON(['error'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'email' => $this->request->getPost('email'),
                'date_of_birth' => $this->request->getPost('birth_date'),
                'roleID' => $this->request->getPost('position'),
                'jersey_num' => $this->request->getPost('jersey_number'),
                'height' => $this->request->getPost('height'),
                'weight' => $this->request->getPost('weight'),
                'status' => $this->request->getPost('status'),
                'order' => $this->request->getPost('order')
            ];
            //check if image is uploaded
            if($imagefile = $this->request->getFile('image'))
            {
                if($imagefile->isValid() && !$imagefile->hasMoved())
                {
                    //generate a random name
                    $newName = $imagefile->getRandomName();
                    //move the file to the designated folder
                    $imagefile->move('assets/images/players/',$newName);
                    //add the image name to the data array
                    $data['image'] = $newName;
                }
            }
            $model->update($this->request->getPost('player_id'),$data);
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function editProfileInfo()
    {
        $model = new playerModel();
        $validation = $this->validate([
            'email' => 'required|valid_email',
            'dob' => 'required|valid_date',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'image' => [
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg,image/png]',
                'max_size[image,2048]',
            ]
        ]);
        if(!$validation)
        {
            return response()->setJSON(['error'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'email' => $this->request->getPost('email'),
                'date_of_birth' => $this->request->getPost('dob'),
                'height' => $this->request->getPost('height'),
                'weight' => $this->request->getPost('weight'),
            ];
            //check if image is uploaded
            if($imagefile = $this->request->getFile('image'))
            {
                if($imagefile->isValid() && !$imagefile->hasMoved())
                {
                    //generate a random name
                    $newName = $imagefile->getRandomName();
                    //move the file to the designated folder
                    $imagefile->move('assets/images/players/',$newName);
                    //add the image name to the data array
                    $data['image'] = $newName;
                }
            }
            $model->update($this->request->getPost('player_id'),$data);
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function withdrawRequest()
    {
        $val = $this->request->getPost('player_id');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {   
            $model = new playerModel();
            $data = ['team_id'=>0,'status'=>2];
            $model->update($val,$data);
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function newPlayers()
    {
        $val = $this->request->getGet('teamId');
        //get the list of players
        $data = $this->db->table('players as a')
                ->select('a.player_id,b.fullname,b.email,b.phone,b.birth_date,b.address,b.file')
                ->join('registration as b','b.user_id=a.user_id')
                ->where('a.team_id',$val)
                ->where('a.status',0);
        $list = $data->get()->getResult();
        return response()->setJSON(['list'=>$list]);
    }

    public function recruitePlayer()
    {
        $val = $this->request->getPost('player_id');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {   
            $model = new playerModel();
            $data = ['status'=>1];
            $model->update($val,$data);
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function declinePlayer()
    {
        $val = $this->request->getPost('player_id');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {   
            $model = new playerModel();
            $data = ['team_id'=>0,'status'=>0];
            $model->update($val,$data);
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function schedules()
    {
        $val = $this->request->getGet('teamId');
        $model = new scheduleModel();
        $schedules = $model->where('team_id',$val)->findAll();
        return response()->setJSON(['schedules'=>$schedules]);
    }

    public function createSchedule()
    {
        $model = new scheduleModel();
        $validation = $this->validate([
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'category'=>'required'
        ]);
        if(!$validation)
        {
            return response()->setJSON(['error'=>$this->validator->getErrors()]);
        }
        else
        {
            $category = $this->request->getPost('category');
            $db = \Config\Database::connect();
            $db->transStart(); 
            $data = [
                'team_id' => $this->request->getPost('team_id'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'location' => $this->request->getPost('location'),
                'category' => $this->request->getPost('category'),
                'status' => $this->request->getPost('status')
            ];
            $model->save($data);
            //get all the new players email
            $players = $this->db->table('players as a')
                        ->select('b.email')
                        ->join('registration as b','b.user_id=a.user_id')
                        ->where('a.team_id',$this->request->getPost('team_id'))
                        ->where('a.status',0)
                        ->get()->getResult();
            foreach($players as $player)
            {
                if($category==="Try-outs")
                {
                    //send email to all new players
                    $emailConfig = new Email();
                    $fromEmail = $emailConfig->fromEmail;
                    $fromName  = $emailConfig->fromName;
                    $email = \Config\Services::email();
                    $email->setTo($player->email);
                    $email->setFrom($fromEmail, $fromName); 
                    $email->setSubject('Welcome to the Team! Upcoming Tryouts Info Inside');
                    $email->setMessage("
                        Dear Players,

                        Welcome aboard! We’re thrilled to have you as part of our growing team. As a newly recruited player, you’re invited to participate in our upcoming team tryouts, where we’ll assess skills, build chemistry, and finalize our roster for the season.

                        📅 Tryout Details:
                        - Date: {$this->request->getPost('date')}
                        - Time: {$this->request->getPost('time')}
                        - Location: {$this->request->getPost('location')}
                        - Attire: Sportswear, team jersey (if available), and proper footwear

                        What to Expect:
                        - Skill drills and position evaluations
                        - Team-building exercises
                        - Brief orientation with coaches and staff

                        Please bring:
                        - Valid ID
                        - Water bottle
                        - Any medical clearance (if required)

                        We encourage you to arrive at least 30 minutes early for registration and warm-up. If you have any questions or need assistance, feel free to reply to this email or contact us.

                        Let’s make this season unforgettable. See you on the court!

                        Warm regards,
                        
                        Digital Sports Hub Team
                    ");

                    $email->send();
                }
                else
                {
                    //send email to all new players
                    $emailConfig = new Email();
                    $fromEmail = $emailConfig->fromEmail;
                    $fromName  = $emailConfig->fromName;
                    $email = \Config\Services::email();
                    $email->setTo($player->email);
                    $email->setFrom($fromEmail, $fromName); 
                    $email->setSubject('Practice Game Invitation and Details');
                    $email->setMessage("
                        Dear Players,

                        📅 Practice Game Details:
                        - Date: {$this->request->getPost('date')}
                        - Time: {$this->request->getPost('time')}
                        - Location: {$this->request->getPost('location')}
                        - Attire: Sportswear, team jersey (if available), and proper footwear

                        What to Expect:
                        - Skill drills and position evaluations
                        - Team-building exercises

                        We encourage you to arrive at least 30 minutes early for warm-up. If you have any questions or need assistance, feel free to reply to this email or contact us.

                        Let’s make this season unforgettable. See you on the court!

                        Warm regards,
                        
                        Digital Sports Hub Team
                    ");
                    $email->send();
                }

            }
            $db->transComplete();
            if ($db->transStatus() === false) {
                // Transaction failed: rollback occurred
                return $this->response->setJSON(['error'=>'Transaction failed']);
            } else {
                // Transaction successful: commit occurred
                return $this->response->setJSON(['success'=>'Successfully added']);
            }
        }
    }

    public function fetchSchedules()
    {
        $val = $this->request->getGet('scheduleId');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {
            $model = new scheduleModel();
            $data = $model->where('schedule_id',$val)->first();
            return response()->setJSON(['schedule'=>$data]);
        }
    }

    public function editSchedule()
    {
        $model = new scheduleModel();
        $validation = $this->validate([
            'edit-date' => 'required',
            'edit-time' => 'required',
            'edit-location' => 'required',
            'edit-category'=>'required'
        ]);
        if(!$validation)
        {
            return response()->setJSON(['error'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'date' => $this->request->getPost('edit-date'),
                'time' => $this->request->getPost('edit-time'),
                'location' => $this->request->getPost('edit-location'),
                'category' => $this->request->getPost('edit-category'),
                'status' => $this->request->getPost('edit-status')
            ];
            $model->update($this->request->getPost('schedule_id'),$data);
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function matches()
    {
        $val = $this->request->getGet('teamId');   
        $builder = $this->db->table('matches as a')
                    ->select("a.*,TIME_FORMAT(a.time, '%h:%i:%s %p') as time,CONCAT(b.team_name,' VS ',c.team_name)team_name")
                    ->join('teams as b','b.team_id=a.team1_id')
                    ->join('teams as c','c.team_id=a.team2_id')
                    ->where('a.team1_id',$val)
                    ->orWhere('a.team2_id',$val);
        $matches = $builder->get()->getResult();
        return response()->setJSON(['matches'=>$matches]);
    }

    public function stats()
    {
        $val = $this->request->getGet('teamId');
        $stats = $this->db->table('player_performance as a')
                        ->select("SUM(CASE WHEN a.stat_type='PTS' THEN stat_value ELSE 0 END)points,
                        c.fullname,d.date,d.time,d.location,CONCAT('VS ',f.team_name)team_name")
                        ->join('players as b','b.player_id=a.player_id')  
                        ->join('registration as c','c.user_id=b.user_id') 
                        ->join('matches as d','d.match_id=a.match_id') 
                        ->join('teams as e','d.team1_id=e.team_id')
                        ->join('teams as f','d.team2_id=f.team_id')
                        ->where('a.team_id',$val)
                        ->groupBy('a.player_id,a.match_id')
                        ->get()->getResult();
        return response()->setJSON(['stats'=>$stats]);
    }

    public function modifyTeam()
    {
        $teamModel = new teamModel();
        $validation = $this->validate([
            'id'=>'required|numeric',
            'team_name'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Name of team is required',
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
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $file = $this->request->getFile('file');
            $originalName = date('YmdHis').$file->getClientName();
            if(empty($file->getClientName()))
            {
                //not change the image
                $data = [
                        'team_name'=>$this->request->getPost('team_name'),
                        'sportsID'=>$this->request->getPost('category'),
                        'school_barangay'=>$this->request->getPost('school_barangay'),
                        'organization'=>$this->request->getPost('organization'),
                        'status'=>$this->request->getPost('status')
                    ];
                $teamModel->update($this->request->getPost('id'),$data);
            }
            else
            {
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
                        'sportsID'=>$this->request->getPost('category'),
                        'school_barangay'=>$this->request->getPost('school_barangay'),
                        'image'=>$originalName,
                        'organization'=>$this->request->getPost('organization'),
                        'status'=>$this->request->getPost('status')
                    ];
                $teamModel->update($this->request->getPost('id'),$data);
            }
            return $this->response->setJSON(['success'=>'Successfully applied changes']);
        }
    }

    public function createMatch()
    {
        $matchModel = new matchModel();
        $teamModel = new teamModel();
        $validation = $this->validate([
            'tournament'=>'required',
            'sports'=>'required',
            'match'=>'required',
            'location'=>'required'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $match = $this->request->getPost('match');
            if($match==="Group")
            {
                $allTeam = $this->request->getPost('teams');
                $teams = [];
            
                foreach ($allTeam as $teamId) {
                    $team = $teamModel->where('team_id', $teamId)->first();
                    if ($team) {
                        $teams[] = $team;
                    }
                }

                // Ensure minimum of 8 teams total (4 per group)
                if (count($teams) < 8) {
                    $errors = ['tournament'=>'At least 8 teams are required (4 per group).'];
                    return $this->response->setJSON(['errors'=>$errors]);
                }

                // Split into two groups
                $groupA = array_slice($teams, 0, ceil(count($teams) / 2));
                $groupB = array_slice($teams, ceil(count($teams) / 2));

                // Function to generate round-robin matches within a group
                function generateGroupMatches($group, $matchModel, $tournament, $location, $groupName) {
                    for ($i = 0; $i < count($group); $i++) {
                        for ($j = $i + 1; $j < count($group); $j++) {
                            $matchModel->insert([
                                'tournament' => $tournament,
                                'match'      => $groupName,
                                'team1_id'   => $group[$i]['team_id'],
                                'team2_id'   => $group[$j]['team_id'],
                                'location'   => $location,
                                'status'     => 1
                            ]);
                        }
                    }
                }
                // Generate matches for each group
                $tournament = $this->request->getPost('tournament');
                $location = $this->request->getPost('location');

                generateGroupMatches($groupA, $matchModel, $tournament, $location,'Group A');
                generateGroupMatches($groupB, $matchModel, $tournament, $location,'Group B');
            }
            else
            {
                $allTeam = $this->request->getPost('teams');
                $teams = [];
                foreach ($allTeam as $teamId) {
                    $team = $teamModel->where('team_id', $teamId)->first();
                    if ($team) {
                        $teams[] = $team;
                    }
                }
                
                // Generate all unique matchups (round-robin style)
                for ($i = 0; $i < count($teams); $i++) {
                    for ($j = $i + 1; $j < count($teams); $j++) {
                        $matchModel->insert([
                            'tournament' => $this->request->getPost('tournament'),
                            'match'=>'Default',
                            'team1_id'   => $teams[$i]['team_id'],
                            'team2_id'   => $teams[$j]['team_id'],
                            'location'   => $this->request->getPost('location'),
                            'status'     => 1
                        ]);
                    }
                }
            }
            return $this->response->setJSON(['success'=>'Success']);
        }
    }

    public function editMatch()
    {
        $matchModel = new matchModel();
        $validation = $this->validate([
            'date'=>'required',
            'time'=>'required',
            'status'=>'required',
            'location'=>'required'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'date'=>$this->request->getPost('date'),
                'time'=>$this->request->getPost('time'),
                'location'=>$this->request->getPost('location'),
                'status'=>$this->request->getPost('status')
            ];
            $matchModel->update($this->request->getPost('id'),$data);
            return $this->response->setJSON(['success'=>'Sucessfully saved changes']);
        }
    }

    public function saveScore()
    {
        $performance = new performanceModel();
        $teamModel = new teamModel();
        $validation = $this->validate([
            'match'=>'required|numeric',
            'player'=>'required|numeric',
            'team'=>'required|numeric',
            'stat'=>'required',
            'points'=>'required|numeric'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $team = $teamModel->where('team_id',$this->request->getPost('team'))->first();
            $data =  [
                'player_id'=>$this->request->getPost('player'),
                'match_id'=>$this->request->getPost('match'),
                'team_id'=>$this->request->getPost('team'),
                'sportsID'=>$team['sportsID'],
                'stat_type'=>$this->request->getPost('stat'),
                'stat_value'=>$this->request->getPost('points'),
                'date'=>date('Y-m-d'),
            ];
            $performance->save($data);
            return $this->response->setJSON(['success'=>'Successfully added']);
        }
    }

    public function openRecruitment()
    {
        $teamModel = new teamModel();
        $val = $this->request->getPost('team');
        $data = ['remarks'=>'OPEN'];
        $teamModel->update($val,$data);
        return $this->response->setJSON(['success'=>'Successfully updated']);
    }

    public function closeRecruitment()
    {
        $teamModel = new teamModel();
        $val = $this->request->getPost('team');
        $data = ['remarks'=>'CLOSE'];
        $teamModel->update($val,$data);
        return $this->response->setJSON(['success'=>'Successfully updated']);
    }

    public function savePlayers()
    {
        $name = array_map('strip_tags', $this->request->getPost('name'));
        $email = array_map('strip_tags', $this->request->getPost('email'));
        $birthDate = array_map('strip_tags', $this->request->getPost('birth_date'));
        $phone = array_map('strip_tags', $this->request->getPost('phone'));
        $height = array_map('strip_tags', $this->request->getPost('height'));
        $weight = array_map('strip_tags', $this->request->getPost('weight'));
        $address = array_map('strip_tags', $this->request->getPost('address'));
        $errors = [];

        for ($i = 0; $i < count($name); $i++) {
            if (empty($name[$i])) {
                $errors["name_$i"] = "Player's name is required.";
            }
            if (empty($email[$i])) {
                $errors["email_$i"] = "Email is required.";
            } elseif (!filter_var($email[$i], FILTER_VALIDATE_EMAIL)) {
                $errors["email_$i"] = "Email is invalid.";
            }
            if (empty($birthDate[$i])) {
                $errors["birth_date_$i"] = "Birth Date is required.";
            }
            if (empty($phone[$i])) {
                $errors["phone_$i"] = "Contact Number is required.";
            }
            if (empty($height[$i])) {
                $errors["height_$i"] = "Height is required.";
            }
            if (empty($weight[$i])) {
                $errors["weight_$i"] = "Weight is required.";
            }
            if (empty($address[$i])) {
                $errors["address_$i"] = "Address is required.";
            }
        }
        if(!empty($errors))
        {
            return $this->response->setJSON(['errors'=>$errors]);
        }
        else
        {
            $registerModel = new registerModel();
            $playerModel = new playerModel();
            for($i=0;$i<count($name);$i++)
            {
                $data = [
                    'application_type'=>'Player',
                    'user_id'=>0,
                    'fullname'=>$name[$i],
                    'email'=>$email[$i],
                    'phone'=>$phone[$i],
                    'birth_date'=>$birthDate[$i],
                    'address'=>$address[$i],
                    'height'=>$height[$i],
                    'weight'=>$weight[$i],
                    'desired_position'=>'Newbie',
                    'status'=>1,
                    'remarks'=>'',
                    'file'=>'',
                    'datecreated'=>date('Y-m-d'),
                    'agreement'=>1
                ]; 
                $registerModel->save($data);
                //players
                $records = [
                    'team_id'=>$this->request->getPost('team'),
                    'user_id'=>0,
                    'date_of_birth'=>$birthDate[$i],
                    'sportsID'=>$this->request->getPost('sports'),
                    'roleID'=>0,
                    'jersey_num'=>0,
                    'gender'=>'Male',
                    'email'=>$email[$i],
                    'height'=>$height[$i],
                    'weight'=>$weight[$i],
                    'address'=>$address[$i],
                    'image'=>'',
                    'status'=>1
                ];
                $playerModel->save($records);
            }
            return $this->response->setJSON(['success'=>'Successfully submitted']);
        }
    }

    public function scorePlayers()
    {
        $performanceModel = new performanceModel();
        $player = array_map('strip_tags', $this->request->getPost('player'));
        $sports = array_map('strip_tags', $this->request->getPost('sports'));
        $team = array_map('strip_tags', $this->request->getPost('team'));
        $match = $this->request->getPost('match');
        $points = array_map('strip_tags', $this->request->getPost('points'));
        $blocks = array_map('strip_tags', $this->request->getPost('blocks'));
        $assist = array_map('strip_tags', $this->request->getPost('assist'));

        $errors = [];

        foreach ($points as $i => $val) {
            if (empty($val)) {
                $errors[] = "Points value missing for player index $i";
            } elseif (!is_numeric($val)) {
                $errors[] = "Points must be numeric for player index $i";
            }
        }

        foreach ($blocks as $i => $val) {
            if (empty($val)) {
                $errors[] = "Blocks value missing for player index $i";
            } elseif (!is_numeric($val)) {
                $errors[] = "Blocks must be numeric for player index $i";
            }
        }

        foreach ($assist as $i => $val) {
            if (empty($val)) {
                $errors[] = "Assist value missing for player index $i";
            } elseif (!is_numeric($val)) {
                $errors[] = "Assist must be numeric for player index $i";
            }
        }

        if (!empty($errors)) {
            return $this->response->setJSON(['errors' => $errors]);
        }
        else
        {
            for($i = 0; $i < COUNT($player); $i++)
            {
                $stats = [
                    ['type' => 'PTS', 'value' => $points[$i]],
                    ['type' => 'BLK', 'value' => $blocks[$i]],
                    ['type' => 'AST', 'value' => $assist[$i]],
                ];

                foreach ($stats as $stat) {
                    $data = [
                        'player_id'   => $player[$i],
                        'match_id'    => $match,
                        'team_id'     => $team[$i],
                        'sportsID'    => $sports[$i],
                        'stat_type'   => $stat['type'],
                        'stat_value'  => $stat['value'],
                        'date'        => date('Y-m-d'),
                        'description' => 'Scores Recorded'
                    ];
                    $performanceModel->save($data);
                }
            }
            return $this->response->setJSON(['success'=>'Successfully submitted']);
        }
    }

    public function addAchievement()
    {
        $achievement = new \App\Models\teamAchievementModel();
        $validation = $this->validate([
            'team'=>'required|numeric',
            'achievement'=>'required'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'team_id'=>$this->request->getPost('team'),
                'achievement_id'=>$this->request->getPost('achievement'),
                'earned_at'=>date('Y-m-d'),
                'status'=>1
            ];
            $achievement->save($data);
            return $this->response->setJSON(['success'=>"Successfully added"]);
        }
    }

    public function deleteAchievement()
    {
        $achievement = new \App\Models\teamAchievementModel();
        $val = $this->request->getPost('value');
        $data = ['team_id'=>0];
        $achievement->update($val,$data);
        return $this->response->setJSON(['success'=>'Successfully removed']);
    }

    public function fetchStaff()
    {
        $val = $this->request->getGet('value');
        if(!is_numeric($val))
        {
            return response()->setJSON(['error'=>'Invalid request']);
        }
        else
        {
            $model = new \App\Models\staffModel();
            $data = $model->where('staff_id',$val)->first();
            return response()->setJSON(['staff'=>$data]);
        }
    }

    public function editStaff()
    {
        $model = new \App\Models\staffModel();
        $validation = $this->validate([
            'staff_name'=>'required',
            'staff_email'=>'required|valid_email',
            'staff_position'=>'required',
            'staff_status'=>'required'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['error'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'name'=>$this->request->getPost('staff_name'),
                'position'=>$this->request->getPost('staff_position'),
                'email'=>$this->request->getPost('staff_email'),
                'status'=>$this->request->getPost('staff_status')
            ];
            $model->update($this->request->getPost('staff_id'),$data);
            return $this->response->setJSON(['success'=>'Successfully updated']);
        }
    }
}