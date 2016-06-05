<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'card_payment/stripe_data.php'; ?> 
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include 'head.php' ?>
  </head>
  <body>
	<?php include 'menu.php'; ?>
	<?php catch_data_for_order(); ?>
	<?php pay_pal_payment(); ?>

	<br />

<div class="row">
	<div class="large -12 columns">
      <h1>Checkout</h1>
      
    	<div class="large-6">
	<br />
	<table>
	<thead>
	<tr style="text-align: left;">
	<th>First name:</th>
	<th>Last name:</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td><?php echo $_COOKIE['user_first_name']; ?></td>
	<td><?php echo $_COOKIE['user_last_name']; ?></td>
	</tr>
	</tbody>
	</table>
		</div>
		<br />
		
			<h3>Products order:</h3>
	
  	<div class="row">
		<div class="large-12 columns">        
     <table> 
        <tr> 
            <th>Model</th> 
            <th>Quantity</th> 
            <th>Price</th> 
            <th>Items Price</th>
        </tr> 
              <?php show_order(); ?>  

          </tr> 
    </table> 
      	</div>
	</div>

	
    
<div class="large-8 medium-7 columns">
	
	<br />
	
<h3>Cart Totals</h3>
<table>
<thead>
<tr>
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>
</thead>
<tbody>
<tr>
<th style="text-align: left">Order Total</th>
<td><strong><?php echo number_format($_SESSION['totalprice'], 2) . ' €'; ?></strong></td>
</tr>
</tbody>
</table>
<br />
</div>

	<div class="row">
	<div class='large-12 columns'>	
		<h3>Shipping data</h3>		
	</div>	

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
      </div>


		<h3>Billing data:</h3>
	

	<div class="row">
        <div class="large-6 columns">
      <label>Address*
        <input type="text" name="billing_address" placeholder="Address:" value="<?php echo $_SESSION['billing_address']; ?>" required />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Postoffice*
        <input type="text" name="billing_postoffice" placeholder="Postoffice:"  value="<?php echo $_SESSION['billing_postoffice']; ?>" required />
      </label>
    </div>
        <div class="large-6 columns">
      <label>City*
        <input type="text" name="billing_city" placeholder="City:"  value="<?php echo $_SESSION['billing_city']; ?>" required />
      </label>
    </div>
       <div class="large-6 columns">
      <label>State
        <input type="text" name="billing_state" placeholder="State:" value="<?php if(!empty($_SESSION['billing_state'])){echo $_SESSION['billing_state'];} ?>" />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Country*
        <input type="text" name="billing_country" placeholder="Country"  value="<?php echo $_SESSION['billing_country']; ?>" required />
      </label>
    </div>
		<div class="large-6 columns">
			<label>Update order shipping and billing data
       	        <p><input type="submit" value="Update order shipping and billing data" class="button expanded" /></p> 
       	        </label>
       </div>
       		<div class="large-6 columns">
       	        <a href="user_personal.php"><p><input value="Permanently update user data" class="button expanded" /></p></a> 
       </div>
      </div>
      </div>
</form>

	<br />
	
<div class="large-4 medium-5 columns">
	
	<br />
	
<h3>Payment methods</h3>
<table>
<tr>
<th>PayPal</th>
<th>Cards</th>
</tr>
<tr>
<td style="text-align: center;">
<form>
				<input type="image" src="<?php echo $path. 'img/page/paypal_check_out.gif'; ?>" name="payment" value="1" alt="Pay with PayPal on Hi-Fi web shop">
</form>
</td>
<td style="text-align: center;">
	
	
	
	<form action="card_payment/procedure.php" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripe['public']; ?>"
    data-amount="<?php echo $_SESSION['totalprice'] * 100; ?>"
    data-name="Hi-Fi"
    data-description="Widget"
    data-image="img/page/logo.png"
    data-locale="auto"
    data-currency="eur">
    data-email="<?php echo $_COOKIE['user_email'] ? $_COOKIE['user_email'] : ''; ?>"
  </script>
</form>
	
	
	
	
	
	
	
	
	
	
	
</td>
</tr>
</tbody>
</table>
</div>
 </div>


<?php include 'footer.php' ?>
<?php include 'script.php' ?>
  </body>
</html>