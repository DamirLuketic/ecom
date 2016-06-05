<?php
	if(!isset($_COOKIE['user_id']) && $_COOKIE['user_role']!='1' && $_COOKIE['user_active'] == '1'){
	header('location: ../index.php');
		}
?>
<?php include '../config.php' ?>
<?php include '../functions.php' ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include '../head.php' ?>
  </head>
  <body>
	<?php include '../menu.php'; ?>

<body>
		<h4>Admin - Orders history</h4>
	    <div class="row">
<?php include 'admin_nav.php'; ?>
	<br />
	<br />

		<div class="large-10 columns">

			 	<div class="row">
		<div class="large-12 columns">
     <table>
        <tr>
        	<th>Order number</th>
        	<th>User</th>
        	<th>Order date</th>
            <th>Price</th>
        </tr>
           <?php orders_history(); ?>
          </tr>
    </table>
    	<br />


<table>
<tr>
<th style="text-align: left">Total cost:</th>
<td style="text-align: right"><strong><?php echo number_format($_SESSION['orders_cost'], 2) . ' €'; ?></strong></td>
</tr>
</table>
      	</div>
	</div>
   </div>
</div>
	<?php include '../footer.php' ?>
	<?php include '../script.php' ?>
  </body>
</html>
