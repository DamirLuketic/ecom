<?php
	if(!isset($_COOKIE['user_id']) && $_COOKIE['user_role']!='1' && $_COOKIE['user_active'] == '1'){
	header('location: ../index.php');
}
?>
<?php include '../config.php' ?>
<?php include '../functions.php' ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include '../head.php' ?>
  </head>
  <body>
	<?php include '../menu.php'; ?>

<body>
	    <div class="row">
<?php include 'admin_nav.php'; ?>

<?php admin_add_item(); ?>

		<div class="large-10 columns">
			<div class="row"></div>
			<h1>Add Product</h1>
				<form>
				  <div class="large-4 columns">
				  <label for="product_model">Product model</label>
      			  <input id="product_model" type="text" name="product_model" required="required" />
      			  </div>
      			  <div class="large-4 columns">
      			  <label for="product_category">Category</label>
         		  <select name="product_category" id="product_category" required="required" />
                    <?php
					$cat = new category_subcategory();
					echo $cat->startCategory();
					?>
                  </select>
				  </div>
				  <div class="large-4 columns">
				  <label for="unit">Units</label>
      			   <select name="unit" id="unit" required="required" />
                    <?php show_units(); ?>
                  </select>
      			  </div>
      			  <label for="product_specification">Product specification</label>
                  <textarea id="product_specification" name="product_specification" cols="30" rows="2"></textarea>
				  <label for="product_description">Product Description</label>
                  <textarea id="product_description" name="product_description" cols="30" rows="10"></textarea>
                  <div class="large-4 columns">
				  <label for="product_price">Product Price</label>
     		      <input id="product_price" type="number" step="0.01" name="product_price" size="60" required="required" />
     		      </div>
      			  <div class="large-4 columns">
				  <label for="quantity">Quantity</label>
      			  <input id="quantity" type="number" name="quantity" required="required" />
      			  </div>
             	<div class="large-4 columns">
             	<label for="add">Add</label>
       	        <p><input id="add" type="submit" value="Add" class="button expanded" /></p>
       			</div>
        </form>
        </div>
    </div>
</div>
	<?php include '../footer.php' ?>
	<?php include '../script.php' ?>
  </body>
</html>
