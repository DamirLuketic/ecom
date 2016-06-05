<?php
	
	namespace plava;	
	 
// Kod promjene osobnih podataka koristimo više formi,
// budući da svaka forma utječe na odrečeni tip podataka.

	class updatePersonalData {
		
		var $con;
	
				function updatePersonalData(){
					
				include '../config.php';
				
				// dio za osobne podatke
							
	if(isset($_COOKIE['user_id'])){		
		if(isset($_POST['display_name']) && isset($_POST['nickname']) && isset($_POST['email']) &&
	      !empty($_POST['display_name']) && !empty($_POST['nickname']) && !empty($_POST['email'])){
	   	
		
		$update_personal_data = $this->con->prepare(' update users set 
												display_name = :display_name, 
												nickname = :nickname, 
												email = :email,
												personal_data = :personal_data
											    where user_id = :user_id ');
		$update_personal_data->execute(array(
											'user_id'		 => $_COOKIE['user_id'],
											'display_name'	 => $_POST['display_name'],
											'nickname' 	 	 => $_POST['nickname'],
											'email' 		 => $_POST['email'],
											'personal_data'  => $_POST['personal_data']
											
										));										
	   				}
		    		
				// Dio za prikazivanje podataka dolazi pred kraj,
				// kako bi se novi podaci prikazali odmah nakon unosa.


	$data = $this->con->prepare(' select a.display_name, a.nickname, a.email, a.personal_data,
	   						b.profile_image, b.cover_image	
							from users as a
							left join images as b on a.user_id = b.user 
							where a.user_id = :user
							');
	$data->execute(array(
						'user' => $_COOKIE['user_id']
					));
	$data = $data->fetch(\PDO::FETCH_OBJ);

	$_SESSION['display_name']       = $data->display_name;
	$_SESSION['nickname'] 			= $data->nickname;
	$_SESSION['email']  			= $data->email;
	$_SESSION['personal_data']  	= $data->personal_data;

	// Dohvaćanje podataka o profilnoj slici,
	// Odnosno postavljanje „default“ profilne slike, ako ista nije zadana.
	

	if(empty($data->profile_image)){
		$_SESSION['profile_image'] = $path . 'img/user/default/user_default.png';
	}else{
		$_SESSION['profile_image'] = $path . 'user/img/' . $_COOKIE['user_id'] . '/profile/' .$data->profile_image;
	}
		
					// Dio za ispravak zaporke
		
		if(isset($_POST['password']) && isset($_POST['password_confirm']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])){
						if($_POST['password']===$_POST['password_confirm']){
							include '../config.php';
								$update_password = $this->con->prepare(' update users set password = md5(:password) where user_id = :user_id ');
								$update_password->execute(array(
											'user_id'	 => $_COOKIE['user_id'],
											'password' 	 => $_POST['password'],
										));	
							echo '<br /><div class="row large-12 columns"> 
       	       					  <p><input type="submit" value="Password updated" class="button expanded" /></p> 
      							  </div>';									
						}else{
							echo '<br /><div class="row large-12 columns"> 
       	       					  <p><input type="submit" value="Password and confirm password not match" class="button expanded" /></p> 
      							  </div>';
						}
					}		
				}		 
			}
	   }
?>	   