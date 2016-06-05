<?php
	if(!isset($_COOKIE['user_id']) && $_COOKIE['user_role']!='1' && $_COOKIE['user_active'] == '1'){
	header('location: ../index.php');
		}

?>
		<div class="large-2 columns">
				<br />
				<br />
				<?php
				$admin_nav = array(
							'admin_add' 		=> 'Add product',
							'admin_update' 	=> 'Update product',
							'admin_orders' 	=> 'Orders history',
							'admin_users' 	=> 'Users',
				);

				foreach($admin_nav as $address => $name){
					echo '<a class="button" href="' . $path . $address . '">' . $name . '</a>';
				}
  				?>

		</div>
