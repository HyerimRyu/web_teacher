<?php

	header("Content-Type:application/json; charset=utf-8");

	//json으로 넘어온 데이터들은 곧바로 $_POST[]라는 슈퍼전역변수에 들어가지 않음...
	//$_POST배열 변수에 json데이터들을 연관배열로 변환(json_decode)하여 넣어주어야 함.
	$_POST= json_decode( file_get_contents('php://input'), true );

	$name= $_POST['name'];
	$msg= $_POST['msg'];

	$arr= array("name"=>$name, "msg"=>$msg);

	echo json_encode($arr, JSON_UNESCAPED_UNICODE);//연관배열을 json문자열로 변경

 ?>