<?php

// for cron in "optima" curl http://www.consilium-europa.com/script_for_cron.php
// for cron in "optima" curl http://www.consilium-europa.com/script_for_cron.php >/dev/null 2>&1 - every 12 hours ???

include 'config.php';

	$cart = $con->query(' select * from carts where TO_SECONDS(in_cart_time) < TO_SECONDS(now()) - 604800 ');
	$carts = $cart->fetchAll(PDO::FETCH_OBJ);
	foreach ($carts as $cart) {
	$in = $con->prepare(' insert into users_hold_on_carts (user,product,quantity,price,in_cart_set) values
						(:user, :product, :quantity, :price, :in_cart_set)				
	');
	$in->execute(array(
			'user' 		  => $cart->user,
			'product'     => $cart->product,
			'quantity'    => $cart->quantity,
			'price' 	  => $cart->price,
			'in_cart_set' => $cart->in_cart_time,
			
	)); }

$del = $con->query(' delete from carts where TO_SECONDS(in_cart_time) < TO_SECONDS(now()) - 604800 ');

?>

<!-- 604800 s is one week -->