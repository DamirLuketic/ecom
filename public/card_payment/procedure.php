<?php 

include '../config.php';
include '../functions.php';
include '../vendor/autoload.php';
include 'stripe_data.php';

if(isset($_POST['stripeToken'])){
	$token = $_POST['stripeToken'];

	try{
	$_SESSION['payment'] = 2;	
	insert_from_cart();	
		
	Stripe\Charge::create(array(
    "amount" => $_SESSION['totalprice'] * 100, // amount in cents, again
    "currency" => "eur",
    "card" => $token,
    "description" => $_COOKIE['user_email']
    ));
	
	header('location: ../main');
	}catch(Stripe_CardError $e){
		
	}



}

