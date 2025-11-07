<?php

namespace App\Models;

use CodeIgniter\Model;

class registerModel extends Model
{
    protected $table            = 'registration';
    protected $primaryKey       = 'register_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'application_type','user_id','fullname','email','phone','birth_date','address','height','weight','desired_position','status','remarks','file','datecreated','agreement'];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}