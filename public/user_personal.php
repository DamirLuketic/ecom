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
  	<?php update_personal_data(); ?>
  	<?php catch_personal_data_user(); ?>
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
			<form method="post">

        <div class="large-6 columns">
      <label>Address*
        <input type="text" name="user_address" placeholder="Address:" value="<?php echo $_SESSION['user_address']; ?>" required />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Postoffice*
        <input type="text" name="user_postoffice" placeholder="Postoffice:"  value="<?php echo $_SESSION['user_postoffice']; ?>" required />
      </label>
    </div>
        <div class="large-6 columns">
      <label>City*
        <input type="text" name="user_city" placeholder="City:"  value="<?php echo $_SESSION['user_city']; ?>" required />
      </label>
    </div>
       <div class="large-6 columns">
      <label>State
        <input type="text" name="user_state" placeholder="State:" value="<?php if(!empty($_SESSION['user_state'])){echo $_SESSION['user_state'];} ?>" />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Country*
        <input type="text" name="user_country" placeholder="Country"  value="<?php echo $_SESSION['user_country']; ?>" required />
      </label>
    </div>
    <div class="large-6 columns">
        <label>Email address*</label>
        <input type="email" name="user_email" placeholder="Email address:"  value="<?php echo $_SESSION['user_email']; ?>" required />       
         </div>
         	<div class="large-7 columns">

            <p><input type="submit" value="Update personal data" class="button expanded" /></p> 

       </div>
        </form>
        <form method="post">
            <div class="large-6 columns">
        <label>Password*</label>
          <input required="required" type="password" name="password" placeholder="Password:" required />
          <br />
        </div>
    <div class="large-6 columns">
        <label>Connfirm password*</label>
          <input required="required" type="password" name="password_confirm" placeholder="Password:" required />
          <br />
        </div>
       <div class="large-6 columns">
      		 	<?php update_password(); ?>
       	        <p><input type="submit" value="Update password" class="button expanded" /></p> 
       </div>
       </form>
    </div> 
</div>
	<?php include 'footer.php' ?>
	<?php include 'script.php' ?>
  </body>
</html>
	
