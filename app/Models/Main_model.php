<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Main_model extends Model {

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email','password','api_access_code'
    ];


     public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
    }



    public function get($id=null){


       return $this->db->table($this->table)->get()->getResultArray();


    }



    public function getColumnDetail($table,$column,$id){

        return $this->db->table($table)->where('id',$id)->get()->getRow()->$column;

    }

   
}


?>