<?php

namespace App\Models;

use CodeIgniter\Model;

class playerModel extends Model
{
    protected $table            = 'players';
    protected $primaryKey       = 'player_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['team_id','user_id','date_of_birth','sportsID','roleID','jersey_num',
                                    'gender','email','height','weight','address','image','status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}