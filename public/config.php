<?php

@session_start();

// home

$path = '/ecom/public/';

// 000webhosting

// $path = '';

// home

$mysql_host = "localhost";
$mysql_database = "ecom";
$mysql_user = "XXXXXXXXXXXXXXXX";
$mysql_password = "XXXXXXXXXXXXXXX";


try{

	$con = new PDO(
	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database,
	$mysql_user,
	$mysql_password,
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		  PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
}catch(PDOException $e){
		switch ($e->getCode()) {
			case 2002:
				echo 'MySQL server is not on given address';
				break;
			case 1049:
				echo 'Wrong database name';
				break;
			case 1045:
				echo 'Wrong user name and/or password';
				break;
			default:
				echo $e->getCode();
				break;
		}
	exit;
}

?>