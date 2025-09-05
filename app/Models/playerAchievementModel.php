<?php

namespace App\Models;

use CodeIgniter\Model;

class playerAchievementModel extends Model
{
    protected $table            = 'player_achievements';
    protected $primaryKey       = 'player_achievement_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['player_id','achievement_id','earned_at','status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}