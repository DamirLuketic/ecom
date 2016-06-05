<?php
	if(!isset($_COOKIE['user_id']) && $_COOKIE['user_role']!='1' && $_COOKIE['user_active'] == '1'){
	header('location: ../index.php');
		}
?>
<?php include __DIR__ . '/../config.php' ?>
<?php include __DIR__ . '/../functions.php'; ?>
<?php include __DIR__ . '/../vendor/autoload.php'; ?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include '../head.php' ?>
  </head>
  <body>
	<?php include '../menu.php'; ?>

<body>
	<?php update_product(); ?>
	<?php
	
	use plava\uploadPictures;

	$images = new uploadPictures();
	$images->con=$con;
	$images->product = isset($_GET['product']) ? $_GET['product'] : '';
	$images->uploadPictures();
	
	?>
	<?php
	if(isset($_GET['product'])){
					include '../config.php';

					$data = $con->prepare(' select a.unit, a.details, a.more_information, a.quantity_in_stock,
											a.price, ifnull(a.deleted, 0) as not_active, b.*
											from products as a
											inner join units as b on a.unit = b.unit_id
											where a.product_id = :product
                                            ;
										 ');
					$data->execute(array('product' => $_GET['product']));
					$info = $data->fetch(PDO::FETCH_OBJ);
		}
	?>

	    <div class="row">
		<?php include 'admin_nav.php'; ?>
		<div class="large-10 columns">
			<div class="row">
			<h1>Update product</h1>
			<form>
				  <div class="large-3 columns">
				  <label for="term_name">Model (SKU)</label>
            	  <input required="required" name="model"  type="search" placeholder="Search by model and\or sku"
            	  		 id="term_name"  value="<?php if(isset($_GET['model'])){ echo $_GET['model']; } ?>" />
      			  </div>
      			  <div class="large-2 columns">
				  <label for="remove_category">Remove categories</label>
      			   <select name="remove_category" id="remove_category" />
      			   <option value="no">No</option>
                   <option value="yes">Yes</option>
                  </select>
      			  </div>
      			  <div class="large-3 columns">
      			  <label for="product_category">Add category</label>
         		  <select name="product_category" id="product_category" />
         		  <option value="no">No</option>
                    <?php
					$cat = new category_subcategory();
					echo $cat->startCategory();
					?>
                  </select>
				  </div>
				  <div class="large-2 columns">
				  <label for="unit">Units  <strong><?php if(isset($info)){ echo '(' . $info->name . ')';}else {echo '';} ?></strong></label>
      			  <select required="required" name="unit" id="unit">
      			  <option value="<?php echo $info->unit_id; ?>">No change</option>
      			  <?php
					$unit = $con->query(' select * from units ');
					$units = $unit->fetchAll(PDO::FETCH_OBJ);
					foreach($units as $unit){
					if($info->unit!=$unit->unit_id){
					echo '<option value="' . $unit->unit_id . '">' . $unit->name . "</option>\n";
						}
					}
                    ?>
                  </select>
      			  </div>
				  <div class="large-2 columns">
				  <label for="active">Active  <strong><?php if(isset($info)){ echo $info->not_active == 0 ? '(Yes)'  : '(No)';}else{echo '';} ?></strong></label>
      			  <select required="required" name="active" id="active">
      			  <option value="<?php echo $info->not_active; ?>">No change</option>
      			  <?php
					if(isset($info)){
						if($info->not_active == 0){
							echo '<option value="1">Inactive</option>';
						}else{
							echo '<option value="0">Active</option>';
						}
					}
                    ?>
                  </select>
      			  </div>

      			  <label for="product_specification">Product specification</label>
                  <textarea id="product_specification" name="product_specification" cols="30" rows="5"><?php if(isset($info)){ echo $info->details; }
                  else {echo '';} ?></textarea>
				  <label for="product_description">Product Description</label>
                  <textarea id="product_description" name="product_description" cols="30" rows="10"><?php if(isset($info)){ echo $info->more_information; }
                  else {echo '';} ?></textarea>
                  <div class="large-3 columns">
				  <label for="product_price">Product Price</label>
     		      <input required="required" id="product_price" type="number" step="0.01" name="product_price" size="60" value="<?php echo $info->price; ?>" />
     		      </div>
      			  <div class="large-3 columns">
				  <label for="quantity">Quantity</label>
      			  <input required="required" id="quantity" type="number" name="quantity"
      			  value="<?php echo $info->quantity_in_stock; ?>" />
      			  </div>				  
    			  <div class="large-3 columns">
    			  <?php
    			  if(isset($_GET['product'])){
    			  $offer = $con->prepare(' select active from special_offer where product = :product and active = 1 ');
				  $offer->execute(array('product' => $_GET['product']));
				  $offers = $offer->fetch(PDO::FETCH_OBJ);
				  }
				  ?>
				  <label for="special_offer">Special offer <strong>
				  <?php if(isset($info)){ echo $offers ? '(in offer)' : '(not in offer)'; }else {echo '';} ?>
				  </strong></label>
      			   <select name="special_offer" id="special_offer" />
      			   <option value="no_change">No change</option>
      			   <?php if(empty($offers)): ?>
      			   <option value="yes">Add</option>
      			   <?php endif; ?>
      			   <?php if(!empty($offers) || !isset($offers)): ?>
      			   <option value="no">Remove</option>
      			   <?php endif; ?>
                   </select>
      			  </div>
             	<div class="large-3 columns">
             	<label for="add">Add</label>
             	<input type="hidden" name="product" value="<?php echo $_GET['product']; ?>" />
       	        <p><input id="add" type="submit" value="Update" class="button expanded" /></p>
       			</div>
        </form>
        </div>
        <hr />
        
        <div class="row">
      	<div class="large-6 columns">      	
        <form method="POST" enctype="multipart/form-data"> 
        <fieldset class="fieldset">	 	
        <legend>Upload featured image</legend>  	
        <input type="file" name="featured_image" />
        </label>   
        <p><input type="submit" value="Submit" class="button expanded" /></p>
        </fieldset>
      	</form>    
    	</div>
    	
    	<div class="large-6 columns">      	
        <form method="POST" enctype="multipart/form-data"> 
        <fieldset class="fieldset">	 	
        <legend>Update non-featured image</legend>  	
        <input type="file" name="non_featured_image" />
        </label>   
        <p><input type="submit" value="Submit" class="button expanded" /></p>
        </fieldset>
      	</form>    
    	    </div>   	    
        </div>	      
    </div>
</div>

	<?php include '../footer.php' ?>
	<?php include '../script.php' ?>
    <script>

	    	$(function (){

    		$("#buttonAjax_name").click(function(){
				return false;
    		});

    		var option = {source: "ccc", minLength:2};
    		$("#term_name").autocomplete({
				    source: "admin/admin_data_for_search_update.php",
				    minLength: 2,
				    focus: function( event, ui ) {
				    	event.preventDefault();
				    	},
				    select: function(event, ui) {
				        $(this).val('').blur();
				        event.preventDefault();

				       document.location.href="admin_update?model=" + ui.item.model + ": " + ui.item.sku + "&product=" + ui.item.product_id;

				    }
					}).data( "ui-autocomplete" )._renderItem = function( ul, object ) {
				      return $( "<p style='background: #DFE8EB; max-width: 13.75rem; margin-bottom: 0'>" )
				        .append( "<a>" + object.model + ": " + object.sku
				         + "</a>" )
				        .appendTo( ul );
				    };

    			});
    </script>
  </body>
</html>
