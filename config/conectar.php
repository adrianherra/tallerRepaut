<?php
	$database="pos";
	$user='repaut';
	$password='Tanela@2023';
	try {
		$con=new PDO('mysql:host=192.169.145.218;dbname='.$database,$user,$password);
	} catch (PDOException $e) {
		echo "Error".$e->getMessage();	
	}

?>