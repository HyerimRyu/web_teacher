<?php 

	header('Content-Type:text/html; charset=utf-8');

	$name= $_POST['name'];
	$message= $_POST['msg'];

	echo "name : $name \n";
	echo "msg : \n $message";
 ?>