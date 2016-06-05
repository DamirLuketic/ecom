<?php

namespace plava;

	class register {
		
		var $con;

	function register(){
		
	//	Započinjemo PHP transakciju
		
			try {
		
	$this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	
	$this->con->beginTransaction();
			
		if(isset($_POST['email']) && !empty($_POST['email'])){
			if($_POST['password']===$_POST['password_confirm']){
			
		// prije same registracije provjeravamo da li je e-mail već u uporabi	
			
			$check_email = $this->con->prepare(' select email from users where email = :email ');
			$check_email->execute(array(
										'email' => $_POST['email']
			));
			
			$check_emails = $check_email->fetchAll(\PDO::FETCH_OBJ);
		
		// Kroz petlju provjeravamo zadani e-mail s e-mail-ovima u bazi.
		// Ako je zadanai e-mail istovjetan s nekim od već postojećih postavljamo
		// „$_SESSION['test'] = 'positive';“, odnosno e-mail prekidamo funkciju, te na kraju ispisujemo grešku.
							
				foreach($check_emails as $check){
				if($_POST['email']==$check->email){
					$_SESSION['test'] = 'positive';
					echo '<div class="row large-12 columns"> 
       	       			  <p><input type="submit" value="Email address already in use" class="button expanded" /></p> 
      					 </div>'; 
				}}
					
			if(!isset($_SESSION['test'])){
							
			$reg = $this->con->prepare(' insert into users(email,password,display_name,nickname,personal_data) values 
								(:email, md5(:password), :display_name, :nickname, :personal_data)
			');
		
			$reg->execute(array(
								'email' 		=> $_POST['email'],
								'password' 		=> $_POST['password'],
								'display_name' 	=> $_POST['display_name'],
								'nickname' 		=> $_POST['nickname'],
								'personal_data' => $_POST['personal_data']			
			));			
 
			$id = $this->con->lastInsertId();
		
		// funkciju "lastInsertId" koristimo kako bi korisniku na dalje napravili direktorije,
		// u kojima će pohranjivati svoje podatke (slike, npr.)
			
			$dir_profile = 'user/img/' . $id . '/profile/';
			mkdir($dir_profile, null, true);
			
			$dir_cover = 'user/img/' . $id . '/cover/'; 
			mkdir($dir_cover, null, true);
			
			$image = $this->con->prepare(' insert into images (user) values (:id) ');
			$image->execute(array('id' => $id));
			
			setcookie('user_id', $id , time() + 86400);			
			header('location: index.php');
			
				}
			if(isset($_SESSION['test'])){
				session_unset($_SESSION['test']);
				}
			}else{
					echo '<div class="row large-12 columns"> 
       	       			  <p><input type="submit" value="Password and confirm password not match" class="button expanded" /></p> 
      					 </div>';
			}
					}else{
						echo '<div class="row large-12 columns"> 
       	       			  <p><input type="submit" value="After successful registration, you will be automatically login" class="button expanded" /></p> 
      					 </div>';
					}
					
		//	Završavamo PHP transakciju			
			
						$this->con->commit();
			
				} catch (Exception $e) {
 				 $this->con->rollBack();
 				 echo "Failed: " . $e->getMessage();
					}	
									
				}
			}

?>