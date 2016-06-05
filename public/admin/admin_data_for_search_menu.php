<?php
include_once '../config.php';

/*

if(!isset($_COOKIE['user_id']) && $_COOKIE['user_role'] != '1'){
	header("location: index.php");
};


 */
if(isset($_GET["term"])){
$term="%" . $_GET["term"] . "%";
}
else {
	$term="%";
}
$expression=$con->prepare("select
						c.category_id as categoryId,
						c.name as categoryName,
						a.product_id as productId,
				 		a.model as productName
						from products a
						inner join categories_products b on a.product_id=b.product
						inner join categories c on b.category=c.category_id where a.quantity_in_stock > 0 and
						concat(a.model,'',c.name) like :term  order by c.name, a.model ");
					$expression->execute(array('term'=> $term ));
					$results = $expression->fetchAll(PDO::FETCH_OBJ);

					echo json_encode($results);
