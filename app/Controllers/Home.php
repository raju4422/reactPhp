<?php

namespace App\Controllers;
use App\Models\Main_model;


use CodeIgniter\HTTP\RequestInterface;




class Home extends BaseController
{

    public function __construct(){

        
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 1000");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function session(){
        $email="test@gmail.com";
        return $email;
    }

    public function get_data(){

        $main_model= new Main_model();
        $res=$main_model->findAll();
        echo json_encode($res);

    }


    public function insert(RequestInterface $request=null){


        $data=array(

            'email'=>$this->request->getVar('email'),
            'password'=>$this->request->getVar('password'),
            'name'=>$this->request->getVar('name'),

        );

        
        $main_model= new Main_model();
        $res=$main_model->insert($data);
        if($res){
            echo json_encode('success');
        }else{
             echo json_encode('failed');
        }
        


    }


    public function get_data_by_id($user_id=null){

        $main_model= new Main_model();
        $res=$main_model->find($user_id);
        echo json_encode($res);

    }


    public function update(RequestInterface $request=null){
        $data=array(
            'email'=>$this->request->getVar('email'),
            'name'=>$this->request->getVar('name'),
            'id'=>$this->request->getVar('id')

        );
        

        $main_model= new Main_model();

        $res=$main_model->save($data);
        echo json_encode($res);
    
    }


    public function delete_user($id){
         $main_model= new Main_model();

        //$res=$main_model->save($data);
        $res = $main_model->where('id', $id)->delete();
        echo json_encode($res);
    }
}
