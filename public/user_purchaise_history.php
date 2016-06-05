<?php 
	if(!isset($_COOKIE['user_id'])){
	header('location: index.php');
} 
?>
<?php include 'config.php' ?>
<?php include 'functions.php' ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include 'head.php' ?>
  </head>
  <body>
	<?php include 'menu.php'; ?>
<body>
    <div class="row">
    <?php include 'user_nav.php' ?>	
	<br />
	<br />

		<div class="large-10 columns">
			
			 	<div class="row">
		<div class="large-12 columns">        
     <table> 
        <tr> 
        	<th>Order number</th> 
        	<th>Order date</th>  
            <th>Items Price</th>
            <th>Action</th>
        </tr> 
           <?php purchaise_history(); ?>
          </tr> 
    </table> 
    	<br />
	

<table>
<tr>
<th style="text-align: left">Total cost:</th>
<td style="text-align: right"><strong><?php echo number_format($_SESSION['purchaises_cost'], 2) . ' €'; ?></strong></td>
</tr>
</table>
      	</div>
	</div>
   </div> 
</div>
	<?php include 'footer.php' ?>
	<?php include 'script.php' ?>
  </body>
</html>
	
