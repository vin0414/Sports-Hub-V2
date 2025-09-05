<?php

namespace App\Models;

use CodeIgniter\Model;

class registerModel extends Model
{
    protected $table            = 'event_registration';
    protected $primaryKey       = 'register_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['event_id','fullname','email','phone','birth_date','address','status','remarks','datecreated'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}