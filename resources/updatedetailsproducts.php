<?php
$niz=array();
$handle = fopen("C:\Users\Luketic\Desktop\New Text Document (3).txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
    	//echo $line;
        if(trim($line)==""){
        	continue;
        }
		$niz[]=str_replace("'","''",$line);
    }

    fclose($handle);
} else {
  // echo "greska";
} 

//print_r($niz);

for($i=1;$i<=67;$i++){
	echo "update products set 
	more_information='" . $niz[rand(0,count($niz)-1)] . "' 
	where product_id=" . $i . ";<br />";
}
