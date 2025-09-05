<?php

namespace App\Models;

use CodeIgniter\Model;

class shopModel extends Model
{
    protected $table            = 'shops';
    protected $primaryKey       = 'shop_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['longitude','latitude','shop_name','address','website','date'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}