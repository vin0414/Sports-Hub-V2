<?php

namespace App\Models;

use CodeIgniter\Model;

class adModel extends Model
{
    protected $table            = 'ads';
    protected $primaryKey       = 'ads_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title','image_url','views','clicks','start_date','end_date','token','dateCreated'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}