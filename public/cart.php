<?php include 'config.php' ?>
<?php include 'functions.php' ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include 'head.php' ?>
  </head>
  <body>
	<?php include 'menu.php'; ?>

	<br />

  	<div class="row">
		<div class="large-12 columns">
     <table>
        <tr>
            <th>Model</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Items Price</th>
            <th>Quantity update</th>
        </tr>
              <?php update_cart_quantity(); ?>
              <?php show_cart(); ?>

		 <tr style="text-align: center; color: #1E331F; background-color: #CBDDFF">
            <td colspan="3" style="text-align: right">Total price:</td>
            <td colspan="1"><?php echo number_format($_SESSION['totalprice'], 2) . ' €'; ?></td>
            <td colspan="1">
            		<?php   cart_model_count();
            				if(isset($_SESSION['count_model']) && $_SESSION['count_model']>0){ ?>
            	<a href="order"><img src="<?php $path ?>img/page/order_now_button.png" style="width: 8em; height: 2.5em;" /></a>
							<?php }else{ ?>
            	<span class="button" style="float: center">Your cart is empty</span>
							<?php } ?>
            </td>
          </tr>
    </table>
    <?php if(isset($_SESSION['count_model']) && $_SESSION['count_model']>0): cart_item_count(); ?>
    <span class="button" style="float: right">Item in cart: <?php echo $_SESSION['cart_item']; ?></span>
    <span class="button" style="float: right">Model in cart: <?php echo $_SESSION['count_model']; ?></span>
    <?php endif; ?>
    <a href="category.php?parent=1"><img src="<?php $path ?>img/page/continue_shopping.png" style="width: 8em; height: 2.5em; float: right" /></a>
      	</div>
	</div>
	<br />

<?php include 'footer.php' ?>
<?php include 'script.php' ?>
  </body>
</html>
