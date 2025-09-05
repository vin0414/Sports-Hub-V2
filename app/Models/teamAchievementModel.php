<?php

namespace App\Models;

use CodeIgniter\Model;

class teamAchievementModel extends Model
{
    protected $table            = 'team_achievements';
    protected $primaryKey       = 'team_achievement_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['team_id','achievement_id','earned_at','status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}