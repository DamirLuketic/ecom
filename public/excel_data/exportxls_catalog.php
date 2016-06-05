<?php 

include_once '../config.php'; 
include '../vendor/autoload.php';


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


date_default_timezone_set('Europe/Zagreb');
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

use PHPExcel;

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Edunova")
							 ->setLastModifiedBy("Edunova")
							 ->setTitle("Proizvodi");

$izraz = $con->prepare("
			
	select * from products where deleted=false
	
	");
$izraz->execute();
$niz = $izraz->fetchAll(PDO::FETCH_OBJ);
$b=1;
foreach ($niz as $red){
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $b, $red->model);
	$objPHPExcel->getActiveSheet()->setCellValue('B' . $b, $red->price);
	$b++;
	
}
$objPHPExcel->getActiveSheet()->setCellValue('B' . $b, "=SUM(B1:B" . ($b-1) . ")");

$objPHPExcel->getActiveSheet()->setTitle('Proizvodi');

$objPHPExcel->getActiveSheet()->getStyle("B1:B" . ($b-1) )->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FF0000')
        )
    )
);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-type: application/vnd.ms-excel');
// It will be called file.xls
header('Content-Disposition: attachment; filename="catalog.xlsx"');
$objWriter->save("php://output");
