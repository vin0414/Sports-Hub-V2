<?php

namespace App\Models;

use CodeIgniter\Model;

class teamModel extends Model
{
    protected $table            = 'teams';
    protected $primaryKey       = 'team_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['team_name','coach_name','accountID','sportsID','school','image'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}