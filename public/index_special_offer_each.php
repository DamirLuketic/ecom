<div class="column">
	
	
<a href="product.php?product=<?php echo $item->product; ?>&category=<?php echo $item->category; ?>" target="_blank">
	<img class="thumbnail" src="<?php echo $path . 'img/products/' . $item->product . '/' .$item->path; ?>">
	</a>
	

<h5><?php echo $item->model; ?></h5>
<p><?php echo $item->price . ' EUR'; ?></p>
<h5><a href="category.php?product_id=<?php echo $item->product . '&quantity=1'; ?>"><?php login_buy(); ?></a></h5>
</div>

