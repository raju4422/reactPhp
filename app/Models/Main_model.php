<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Main_model extends Model {

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email','password'
    ];

   
}


?>