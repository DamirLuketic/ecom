<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>

<?php login(); ?>

<br />
<br />
<div class="row">
  <div class="medium-6 medium-centered large-4 large-centered columns">
    <form method="post">
      <div class="row column login">
        <h4 class="text-center"><?php login_try(); ?></h4>
        <br />
        <label for="email">Email</label>
          <input required="required" type="text" id="email" name="email" placeholder="somebody@example.com"  />
        <label for="password">Password</label>
          <input required="required" type="password" id="password" name="password" placeholder="Password"  /">
        <p><input type="submit" value="Submit" class="button expanded" /></p>
      </div>
    </form>
  </div>
</div>
<br />
<br />

<?php include 'footer.php'; ?>
<?php include 'script.php'; ?>