<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
<br />
<br />
<div class="row">
  <div class="medium-6 medium-centered large-4 large-centered columns">
      <div class="row column login">
			<form>
        		<label for="email">Email</label>
        		<input required="required" type="email" id="email" name="email" placeholder="somebody@example.com"  />
        		<label for="subject">Subject</label>
        		<input required="required" type="text" id="subject" name="subject" placeholder="subject"  />
        		<label for="message">Message</label>
        		<textarea required="required" id="message" name="message" rows="7" cols="30" placeholder="message"></textarea>		
				<br />
				<input type="Submit" value="Submit">	
			</form>
			<br />
			<?php 
				if(isset($_GET['email']) && isset($_GET['subject']) && isset($_GET['message']) && !empty($_GET['email']) && !empty($_GET['subject']) && !empty($_GET['message'])){
					mail('luketic.damir@gmail.com', $_GET['subject'], $_GET['message'],$_GET['email']);
					echo '<h5 style="text-align: center">Your e-mail has bean sent</h5>';
				}else{
					echo '<h6 style="text-align: center">Please fill all fields</h6>';
				}
			?>
			</div>
		</div>
	</div>
<br />
<br />
<?php include 'footer.php'; ?>
<?php include 'script.php'; ?>