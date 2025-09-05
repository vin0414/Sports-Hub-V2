<?php

namespace App\Models;

use CodeIgniter\Model;

class viewsModel extends Model
{
    protected $table            = 'views';
    protected $primaryKey       = 'view_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['video_id','total_view','date','watched_seconds','ip_address'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}