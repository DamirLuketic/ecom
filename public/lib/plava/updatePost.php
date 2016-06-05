<?php
	
namespace plava;

	class updatePost{
		
		var $con;	
		
  function updatePost(){
  	
	// kod ispravke objave, možemo izabrati i opciju "briši", te se potom odvija brisanje iz baze,
	// u suprotnom se zadavanjem ispravljenog teksta objava ispravlja na novi tekst. 
	
if(isset($_POST['post_for_edit']) && isset($_POST['edit_post'])){
	if(isset($_POST['delete'])){
		$delete = $this->con->prepare(' delete from posts where post_id = :post_id and user = :user');
		$delete->execute(array(
							'post_id' => $_POST['post_for_edit'],
							'user' => $_COOKIE['user_id']
						));	
	}else{
$update = $this->con->prepare(' update posts set post = :post, post_updated = now() where post_id = :post_id and user = :user ');
$update->execute(array(
							'post' => $_POST['edit_post'],
							'post_id' => $_POST['post_for_edit'],
							'user' => $_COOKIE['user_id']
));
				}
			}			
		}	 
	}

?>