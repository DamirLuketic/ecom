<?php
include_once '../config.php'; 
if(!isset($_COOKIE['user_id']) || !isset($_GET["purchaise_id"])){
	return;
}
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once 'tcpdf.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($_GET['purchaise_id']);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Hi-Fi web shop' , 'Order number: ' . $_GET['purchaise_id'] . 
															"\r\n" . 'Order date: ' . date('Y/m/d', strtotime($_GET['date'])),  
PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array('dejavusans', '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array('dejavusans', '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont('dejavusans');

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// dejavusans or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


$html="";

$html.='<table border="1">
		<thead>
		<tr>
		<th>Model</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Total item price</th>
		</tr>
		</thead>
		<tbody>';
			
			
			$purchaise = $con->prepare(' select b.model, a.price, a.quantity, a.quantity * a.price as total
										 from invoices_items as a
										 inner join products as b on a.product = b.product_id
										 where a.invoice = :purchaise_id  ');
					
					$purchaise->execute(array('purchaise_id' => $_GET['purchaise_id']));							 
					$purchaises = $purchaise->fetchAll(PDO::FETCH_OBJ);
					
					$purchaises_cost = 0;							
					foreach ($purchaises as $purchaise):
						$html.='<tr>
									<td>' . $purchaise->model.     '</td>
									<td style="text-align: center">' . $purchaise->quantity . '</td>
									<td style="text-align: right">' . number_format($purchaise->price, 2) .    ' €</td>
									<td style="text-align: right">' . number_format($purchaise->total, 2) .    ' €</td>
							   </tr>';
						$purchaises_cost+=$purchaise->total;
					endforeach;
				$html.='</tbody>
			</table>

<table>
<tr>
<th style="text-align: left">Total cost:</th>
<td style="text-align: right"><strong>' . number_format($purchaises_cost, 2) . ' €</strong></td>
</tr>
</table>';


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('invoice_' . $_GET['purchaise_id'] . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
