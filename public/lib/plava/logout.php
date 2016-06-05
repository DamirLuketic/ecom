<?php
	
namespace plava;

	class logout{
		
		var $con;	
	
   function logout(){

// Korisnik se odjavljuje, postavljanjem vremena cookia za prijavu na 1 sec.

			setcookie('user_id','', 1);
			
			header('location: index.php');
			}
		}

?>