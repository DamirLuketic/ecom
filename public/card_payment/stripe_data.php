<?php
	if(!isset($_COOKIE['user_id']) && $_COOKIE['user_role']!='1' && $_COOKIE['user_active'] == '1'){
	header('location: ../main');
}
	
	include __DIR__ . '/../vendor/autoload.php';
	
	$stripe = array(
		'public'  => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
		'private' => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
	);

use Stripe\Stripe;

 Stripe::setApiKey($stripe['private']);
