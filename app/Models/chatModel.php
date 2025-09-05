<?php 

namespace App\Models;

use CodeIgniter\Model;

class chatModel extends Model
{
    protected $table = 'chat_messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sender_id', 'message'];
    protected $returnType = 'array';
    protected $useTimestamps = true;

}