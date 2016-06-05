<?php
include_once '../config.php';

	if(!isset($_COOKIE['user_id']) && $_COOKIE['user_role']!='1' && $_COOKIE['user_active'] == '1'){
	header('location: ../index.php');
		}

if(isset($_GET["term"])){
$term="%" . $_GET["term"] . "%";
}
else {
	$term="%";
}
					$expression=$con->prepare("select model, sku, product_id from products where concat(model,'',sku) like :term_name order by model ");
					$expression->execute(array('term_name'=> $term ));
					$results = $expression->fetchAll(PDO::FETCH_OBJ);

					echo json_encode($results);
