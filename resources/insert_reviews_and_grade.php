<?php
$niz=array();
$handle = fopen("C:\Users\Luketic\Desktop\New Text Document (5).txt", "r");
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

for($i=1;$i<=200;$i++){
	echo 'insert into reviews (user, product, grade, review) values
							 (' .  rand(1,3) . ',' . rand(1,66) . ',' . rand(1,5) . ',"' . $niz[rand(0,count($niz)-1)] . '");<br />';
}	