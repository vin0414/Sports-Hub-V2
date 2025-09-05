<?php

namespace App\Models;

use CodeIgniter\Model;

class teamStatsModel extends Model
{
    protected $table            = 'team_stats';
    protected $primaryKey       = 'team_stats_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['team_id','wins','losses','draws','score','match_id','coachID'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}