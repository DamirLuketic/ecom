<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
<br />
<?php register(); ?>

<br />
<form method="post">
	<div class="row">
    <div class="large-6 columns">
      <label>First name*
    	<input required="required" type="text" name="firstname" placeholder="First name:" />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Last name*
        <input required="required" type="text" name="lastname" placeholder="Last name:" />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Adress*
        <input required="required" type="text" name="address" placeholder="Address:" />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Postoffice*
        <input required="required" type="text" name="postoffice" placeholder="Postoffice:" />
      </label>
    </div>
        <div class="large-6 columns">
      <label>City*
        <input required="required" type="text" name="city" placeholder="City:" />
      </label>
    </div>
       <div class="large-6 columns">
      <label>State
        <input type="text" name="state" placeholder="State:" />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Country*
        <input required="required" type="text" name="country" placeholder="Country" />
      </label>
    </div>
    <div class="large-6 columns">
        <label>Email address*</label>
        <input required="required" type="email" name="email" placeholder="Email address:" />       
         </div>
    <div class="large-6 columns">
        <label>Password*</label>
          <input required="required" type="password" name="password" placeholder="Password:" />
          <br />
        </div>
    <div class="large-6 columns">
        <label>Connfirm password*</label>
          <input required="required" type="password" name="password_confirm" placeholder="Password:" />
          <br />
        </div>
       <div class="large-12 columns">
       	        <p><input type="submit" value="Register and login" class="button expanded" /></p> 
       </div>
      </div>     
</form>
<br />
<br />

<?php include 'footer.php'; ?>
<?php include 'script.php'; ?>



