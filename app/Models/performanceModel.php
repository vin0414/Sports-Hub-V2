<?php

namespace App\Models;

use CodeIgniter\Model;

class performanceModel extends Model
{
    protected $table            = 'player_performance';
    protected $primaryKey       = 'performance_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['player_id','match_id','team_id','sportsID','stat_type','stat_value','date','description'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}