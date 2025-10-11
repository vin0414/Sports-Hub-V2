<?php

namespace App\Controllers;
use Config\App;
use \App\Models\registerModel;
use \App\Models\teamModel;
use \App\Models\playerModel;
use \App\Models\scheduleModel;
use \App\Models\matchModel;
use \App\Models\performanceModel;
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
        $pending = $registerModel->where('status',0)->findAll();
        return response()->setJSON(body: ['pending'=>$pending]);
    }

    public function getApproveList()
    {
        if(empty(session()->get('loggedUser')))
        {
            return redirect()->back();
        }
        $registerModel = new registerModel();
        $approve = $registerModel->where('status',1)->findAll();
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
            $data = [
                'team_id'=>$val,
                'user_id'=>session()->get('User'),
                'date_of_birth'=>$register['birth_date'],
                'sportsID'=>$team['sportsID'],
                'roleID'=>0,
                'jersey_num'=>0,
                'gender'=>'Male',
                'email'=>session()->get('user_email'),
                'height'=>0,
                'weight'=>0,
                'address'=>$register['address'],
                'image'=>'',
                'status'=>0
            ];
            $model->save($data);
            return response()->setJSON(['success'=>'Successfully submitted']);
        }
    }

    public function playerList()
    {
        $val = $this->request->getGet('teamId');
        //get the list of players
        $data = $this->db->table('players as a')
                ->select('a.*,b.Fullname,c.roleName')
                ->join('users as b','b.user_id=a.user_id')
                ->join('player_role as c','c.roleID=a.roleID')
                ->where('a.team_id',$val)
                ->where('a.status',1);
        $players = $data->get()->getResult();
        return response()->setJSON(['players'=>$players]);
    }
    

    public function newPlayers()
    {
        $val = $this->request->getGet('teamId');
        //get the list of players
        $data = $this->db->table('players as a')
                ->select('a.player_id,b.fullname,b.email,b.phone,b.birth_date,b.address')
                ->join('registration as b','b.user_id=a.user_id')
                ->where('a.team_id',$val)
                ->where('a.status',0);
        $list = $data->get()->getResult();
        return response()->setJSON(['list'=>$list]);
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
            'location' => 'required'
        ]);
        if(!$validation)
        {
            return response()->setJSON(['error'=>$this->validator->getErrors()]);
        }
        else
        {
           
            $db = \Config\Database::connect();
            $db->transStart(); 
            $data = [
                'team_id' => $this->request->getPost('team_id'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'location' => $this->request->getPost('location'),
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
                //send email to all new players
                $emailConfig = new Email();
                $fromEmail = $emailConfig->fromEmail;
                $fromName  = $emailConfig->fromName;
                $email = \Config\Services::email();
                $email->setTo($player->email);
                $email->setFrom($fromEmail, $fromName); 
                $email->setSubject('New Schedule Created');
                $email->setMessage('A new schedule has been created. Please check your team roster for more details.');
                $email->send();
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
            'date' => 'required',
            'time' => 'required',
            'location' => 'required'
        ]);
        if(!$validation)
        {
            return response()->setJSON(['error'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
                'location' => $this->request->getPost('location'),
                'status' => $this->request->getPost('status')
            ];
            $model->update($this->request->getPost('schedule_id'),$data);
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }

    public function matches()
    {
        $val = $this->request->getGet('teamId');   
        $model = new matchModel();
        $matches = $model->where('team1_id',$val)->orWhere('team2_id',$val)->findAll();
        return response()->setJSON(['matches'=>$matches]);
    }

    public function stats()
    {
        $val = $this->request->getGet('teamId');
    }
}