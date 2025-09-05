<?php

namespace App\Models;

use CodeIgniter\Model;

class matchModel extends Model
{
    protected $table            = 'matches';
    protected $primaryKey       = 'match_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['date','time','team1_id','team1_score','team2_id','team2_score','location','result','status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}