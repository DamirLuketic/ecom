<?php
for($i=1;$i<=66;$i++){
echo '(null,' . $i . ',1,(select price from products where product_id=' . $i . ')),<br />';

}
?>