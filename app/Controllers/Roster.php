<?php

namespace App\Controllers;
use Config\App;
use \App\Models\registerModel;
use \App\Models\teamModel;
use \App\Models\playerModel;

class Roster extends BaseController
{
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
}