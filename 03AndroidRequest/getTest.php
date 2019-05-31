<?php 

	header('Content-Type:text/html; charset=utf-8');

	$name= $_GET['name'];
	$message= $_GET['msg'];

	//응답 결과 
	echo "이름 : $name,  메세지 : $message";

 ?>