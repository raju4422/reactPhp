<?php

function authenticate($username,$password){

}

function apiAuth($apicode=null){

 $db   = \Config\Database::connect();
 $data = $db->query('select * from users where api_access_code="'.$apicode.'"')->getNumRows();

if($data==1){
	return true;
}else{
	return false;
}

        

	

}


 



?>