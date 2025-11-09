<?php

namespace App\Models;

use CodeIgniter\Model;

class user_permission extends Model
{
    protected $table            = 'user_permissions';
    protected $primaryKey       = 'up_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['role','roster','events','matches','scoreboard','videos','news','shops','maintenance'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}