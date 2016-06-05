<?php 
	if(!isset($_COOKIE['user_id'])){
	header('location: index.php');
} 
?>
		<div class="large-2 columns">
				<br />
				<br />
			<?php	
				$user_pages = array(
						'user_personal' 		 => 'Personal data',
						'user_purchaise' 		 => 'Purchaise history'
				);
				
				foreach($user_pages as $address => $name){
					echo '<a class="button" href="' . $path . $address . '">' . $name . '</a>';
				}				
  				?>	
		</div>