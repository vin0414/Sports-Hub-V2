<?php

namespace App\Models;

use CodeIgniter\Model;

class videoModel extends Model
{
    protected $table            = 'videos';
    protected $primaryKey       = 'video_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['file_name','description','accountID','file','sportName','date','status','Token'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}