<?php

namespace App\Controllers;
use App\Models\Main_model;
use CodeIgniter\HTTP\RequestInterface;




class Home extends BaseController
{


    protected $db;
     protected $session;

    public function __construct(){
    
        
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Max-Age: 1000");
            header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
            header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

            $this->db = \Config\Database::connect();

            $this->session = \Config\Services::session();
            helper('common');

    }


    public function index()
    {
        return view('welcome_message');
    }

    public function session(){
        $email="test@gmail.com";
        return $email;
    }

    public function dummy(){
        $data=apiAuth('raju123');
        var_dump($data);
    }

    public function get_data($api=null){
       // if(apiAuth('260566')){
        // $builder= $this->db->table('users');
        // $res = $builder->get()->getResultArray();
        $main_model= new Main_model();
        $res=$main_model->get();

        echo json_encode($res);
    // }
    
         
    }


    public function insert(RequestInterface $request=null){


        $data=array(

            'email'=>$this->request->getVar('email'),
            'password'=>password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
            'name'=>$this->request->getVar('name'),
            'api_access_code' =>rand(100000,999999)

        );

        
        $main_model= new Main_model();
        $res=$main_model->save($data);
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

    public function authenticate(RequestInterface $request=null){
           $res=null;

           $email=$this->request->getVar('email');
           $password=$this->request->getVar('password');
           $email ="demoraju@gmail.com";
           $password = '123456';
            $main_model= new Main_model();

            $builder= $this->db->table('users');
            $count = $builder->where('email',$email)->get()->getNumRows();
            if($count==1){
                $user_data=$builder->where('email',$email)->get()->getRowArray();
                if(password_verify($password, $user_data['password'])){

                $set=$builder->where('id',$user_data['id'])->set('api_access_code',rand(100000,999999))->update();
                if($set){
                    $session_array=array('id'=>$user_data['id'],'api_access_code'=>$main_model->getColumnDetail('users','api_access_code',$user_data['id']),'user_email'=>$user_data['email']);
                }

                    $this->session->set($session_array);

                    $res=array('response'=>true,'msg'=>'Your password is Correct','session_data'=>$this->session->get());
                }else{
                     $res=array('response'=>false,'msg'=>'Please Enter Correct Password');
                }

            }else{
               $res=array('response'=>false,'msg'=>'Please Enter Correct Email');
            }

            echo json_encode($res);

    }
}
