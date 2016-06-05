<div class="row column text-center">
<h2>Special offer</h2>
<hr>
</div>
<div class="row small-up-2 medium-up-3 large-up-6">
<?php
		
$special = $con->query(' select a.model, a.price, b.path , c.product, d.category, a.quantity_in_stock, e.quantity
					  	 from products as a 
						 inner join images as b on a.product_id = b.product
						 left join special_offer as c on a.product_id = c.product
						 inner join categories_products as d on a.product_id = d.product
						 left join carts as e on a.product_id = e.product			
						 where c.active = 1 and
						 b.featured is true and
						 a.quantity_in_stock > 0 and
						 a.deleted = 0
						 group by d.product						
						');
$specials = $special->fetchAll(PDO::FETCH_OBJ);
foreach ($specials as $item) {
	if($item->quantity_in_stock>$item->quantity){
	include 'index_special_offer_each.php';
	}
}	
?>

</div>