<?php
	
namespace plava;

	class login{
		
		var $con;	
	
   function login(){

if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){
	
$user = $this->con->prepare(" select * from users where email=:email and password = md5(:password) ");

$user->execute(array(
			'email'    => $_POST["email"],
			'password' => $_POST["password"]
));

$user = $user->fetch(\PDO::FETCH_OBJ);

// Postavio sam korisnika prijavljenim tjedan dana (86400 sec.)

if(isset($user->user_id)){	
			setcookie('user_id', $user->user_id, time() + 86400);			
					header('location: index.php');
					}
				}
			}
	}

?>