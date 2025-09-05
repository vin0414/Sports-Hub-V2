<?php

namespace App\Models;

use CodeIgniter\Model;

class teamRegistrationModel extends Model
{
    protected $table            = 'team_registration';
    protected $primaryKey       = 'registration_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['event_id','team_id','accountID','status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}