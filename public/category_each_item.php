	<div class="column callout">
	<a href="product.php?product=<?php echo $item->product; ?>&category=<?php echo $_GET['category']; ?>" target="_blank">
	<img class="thumbnail" src="<?php echo $path . 'img/products/' . $item->product . '/' .$item->path; ?>" 
	 alt="<?php echo $item->model; ?>" width="400" height="500">
	</a>
	<h6><?php echo 'Model: ' . $item->model . '<br />' . 'Available : ';
	border($item->product);
	echo '<br />' . 'Price: ' . number_format($item->price, 2) . ' €'; ?></h6>
	<h6>Reviews: <?php echo $item->reviewcount; ?></h6>
	<span class="stars"><?php echo $item->averagegrade; ?></span><br />
	<?php if(isset($_COOKIE['user_id'])): ?>
	<form>
	<input required="required" type="number" name="quantity" min="0" max="<?php border($item->product); ?>" />
	<input type="hidden" name="product_id" value="<?php echo $item->product . '&q=p'; ?>" />
	<input type="submit" value="Buy" />
	</form>
	<?php endif; ?>
	<?php if(!isset($_COOKIE['user_id'])): ?>
	<a href="login.php">Login</a> \ <a href="register.php">Register</a>
	<?php endif; ?>
	</div>
