<?php include '../config.php'; 

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=catalog.csv;');

$expression = $con->prepare("
			
	select * from products where deleted=false
	
	");
$expression->execute();
$array = $expression->fetchAll(PDO::FETCH_OBJ);
$total=0;
foreach ($array as $row){
	echo $row->model . ";" . $row->price . " EUR" . "\n";
	$total+=$row->price;
}
echo ";" . $total;


