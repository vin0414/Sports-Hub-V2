<?php

namespace App\Controllers;
use Config\App;
use \App\Models\registerModel;

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

    public function confirmation()
    {
        $val = $this->request->getPost('value');
        if(!is_numeric($val))
        {
            echo "Invalid! Please try again";
        }
        else
        {   
            $registerModel = new registerModel();
            $data = ['status'=>1,'remarks'=>'Registered'];
            $registerModel->update($val,$data);
            return response()->setJSON(['success'=>'Successfully updated']);
        }
    }
}