<?php include 'config.php' ?>
<?php include 'functions.php' ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include 'head.php' ?>
  	
  	<style type="text/css">
		span.stars, span.stars span {
			display: block;
			background: url("<?php echo $path . "img/page/stars.png" ?>") 0 -16px repeat-x;
			width: 80px;
			height: 16px;
		}
	
		span.stars span {
			background-position: 0 0;
		}
	</style>
	
	<style>
  			.row {
    			max-width: 95%;
			}
  		</style>
	
  </head>
  <body>	
  	<?php add_item(); ?>
  	<?php add_review(); ?>
	<?php include 'menu.php'; ?>
	<br />
	<div class="row">
		<div class="large-12 columns">
			<div class="callout">
				 <ul class="breadcrumbs">
				 	<?php bread_crumps(); ?>			 	
				 </ul>
								 
				 <div class="row">
					<div class="large-7 columns">						
					<img style="max-width: 100%;" src="<?php featured_images(); ?>" />
				 <div class="row">
					 	<br />
					 	<div class="large-12 show-for-medium columns">
					 		<?php show_not_featured_images(); ?>			
						 	</div>
						 </div>
					</div>	
					<div class="large-5 columns">
					<?php 	
					$expression = $con->prepare("select a.model, ifnull(avg(b.grade),0) as average, 
					a.price, a.quantity_in_stock, a.sku, a.details, a.more_information, count(b.id) as reviewcount
		            from products as a 
				    left join reviews as b on a.product_id = b.product
	      			where a.product_id=:product");						 
					$expression->execute(array("product"=>$_GET["product"]));
					$o = $expression->fetch(PDO::FETCH_OBJ);	
					?>	
					<h1><?php echo $o->model; ?></h1>
					<br />
					<h5 style="float: left;">Reviews: <?php echo $o->reviewcount; ?></h5><br />
					<?php if($o->average>0){
						echo '<span class="stars">' . $o->average. '</span>';
					}
				 	?>
				 	<br /><br />
				 	<h3><?php echo $o->price . ' €'; ?></h3>
				 	<?php 
				 	$border = $con->prepare(' select ifnull(a.quantity_in_stock,0) as quantity_in_stock, sum(ifnull(b.quantity,0)) as in_cart
											  from products as a
										      left join carts as b on a.product_id = b.product
									          where a.product_id = :product
											');	
					$border->execute(array('product' => $_GET['product']));
					$borders = $border->fetch(PDO::FETCH_OBJ);
					$border = $borders->quantity_in_stock-$borders->in_cart;	
				 	?>
				 	<h4 style="text-align: left !important;"><?php echo $border>0 ? $border . ' IN STOCK' : ' OUT OF ';?></h4>
				 	<br />
				 	<h5><?php echo 'SKU #:' . $o->sku;?></h5>
				 	<br />
				 	
					<div class="row">
				 		
				 			<?php if(isset($_COOKIE['user_id'])): ?>
				 				<div class="large-3 medium-5 columns">
				 					<form>
									<input required="required" type="number" name="quantity" min="0" max="<?php echo $border; ?>" />
									<input type="hidden" name="product_id" value="<?php echo $_GET['product'] . '&q=p'; ?>" />
									<input type="submit" value="Buy" />
									</form>
				 			<?php else:?>
				 				<div class="large-12 columns">
				 				Please <a href="login.php">login</a>\<a href="register.php">register</a> for adding to Cart
				 			<?php endif;?>
				 			<br />
				 		</div>
				 	</div>				 	
				</div>				
			</div>
			<br />
						
						<?php
						$rev = $con->prepare(' select review, user from reviews where product = :product ');
						$rev->execute(array('product' => $_GET['product']));
						$reviews = $rev->fetchAll(PDO::FETCH_OBJ);
						
//  osobno 
// a) funkcija za provjeru podatka u std nizu  - unesemo niz ($reviews)
						
						$user = array_map(function($item) {
  						  return $item->user;
						}, $reviews);
						
// b) unesemo što traži i gdje						
						if(isset($_COOKIE['user_id'])){
						if (!in_array($_COOKIE['user_id'], $user)) {
							$user_review_text = 'Add review';
							$_SESSION['user_review_test'] = 'n';
						}else{
							$user_review_text = 'Change review';
							$_SESSION['user_review_test'] = 'p';
							}							
						}										
						?>	
			<div class="row">
					<div class="large-12 columns">
						<ul class="tabs" data-tabs id="example-tabs">
						  <li class="tabs-title is-active"><a href="#details" aria-selected="true">Details</a></li>
						  <li class="tabs-title"><a href="#more_information">More information</a></li>
						  <li class="tabs-title"><a href="#reviews">Reviews</a></li>
						  <?php if(isset($_COOKIE['user_id'])): ?>
						  <li class="tabs-title"><a href="#add_review"><?php echo $user_review_text; ?></a></li>
						  <?php endif; ?>
						</ul>					
						<div class="tabs-content" data-tabs-content="example-tabs">
						  <div class="tabs-panel is-active" id="details">
						    <p><?php echo  $o->details; ?></p>
						  </div>
						  <div class="tabs-panel" id="more_information">
						    <p><?php echo  $o->more_information; ?></p>
						  </div>
						  <div class="tabs-panel" id="reviews">
						  	<?php 					  	
								foreach($reviews as $review){
									if(!empty($review->review)){
								  	echo '<div class="callout"><p>' . $review->review . '</p></div>';
								  }	
								}	
							?>
						  </div>
						  <?php 
						  if(isset($_COOKIE['user_id'])){
						  $check = $con->prepare(' select grade, review from reviews where user = :user and product = :product ');
						  $check->execute(array(
						  						'user' 		=> $_COOKIE['user_id'],
						  						'product' 	=> $_GET['product']
						  ));
						  $checks = $check->fetch(PDO::FETCH_OBJ);
						  
						  $grade  = isset($checks->grade) ? $checks->grade : '';
						  $review = isset($checks->review) ? $checks->review : '';
						  }
						  ?>
						  <?php if(isset($_COOKIE['user_id'])): ?>						  
						  <div class="tabs-panel" id="add_review">					  	
						  	<form method="post">					  		
						  	<div class="row">
						  	<div class="large-2 columns">					  							  		
						  	<fieldset class="fieldset">	
						  	<legend>Grade:</legend>
							  <input type="radio" name="grade" value="1" <?php echo $grade==1 ? 'checked="checked"' : ''; ?>>  1</input><br>
							  <input type="radio" name="grade" value="2" <?php echo $grade==2 ? 'checked="checked"' : ''; ?>>  2</input><br>
							  <input type="radio" name="grade" value="3" <?php echo $grade==3 ? 'checked="checked"' : ''; ?>>  3</input><br>
							  <input type="radio" name="grade" value="4" <?php echo $grade==4 ? 'checked="checked"' : ''; ?>>  4</input><br>
							  <input type="radio" name="grade" value="5" <?php echo $grade==5 ? 'checked="checked"' : ''; ?>>  5</input>					  	
						  	</div>	
						  	<div class="large-10 columns">	
			  				<fieldset class="fieldset">
			  				<legend>New review:</legend>
              				<textarea name="new_review" cols="30" rows="7"><?php echo $review; ?></textarea>
              				<input type="hidden" name="product" value="<?php echo $_GET['product']; ?>" />
              				<input type="hidden" name="category" value="<?php echo $_GET['category']; ?>" />
          	  				<input type="submit" value="submit" />
              				</fieldset>
							</form>							  	
						  	</div>	
						  	</div>							  	
						  </div>
						  <?php endif; ?>					  
						</div>	
					</div>
				</div>	
			</div>
		</div>		
	</div>
	</div>    
	<?php include 'footer.php' ?>
	<?php include 'script.php' ?>
	<script>
    	
    	$.fn.stars = function() {
			return $(this).each(function() {
				$(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).html())))) * 16));
			});
		}
		
		$('span.stars').stars();
    	
    </script>
  </body>
</html>
