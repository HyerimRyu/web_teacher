<?php 

	header('Content-Type:text/html; charset=utf-8');

	$name= $_POST['name'];
	$message= $_POST['msg'];
	//작은따옴표같은 것이 메세지 안에 있으면 오류나기에..
	//작은따음표앞에 역슬래쉬(\)를 추가해주는 함수실행
	$message= addslashes($message);

	$srcFileName= $_FILES['upload']['name'];
	$tmpFileName= $_FILES['upload']['tmp_name'];
	$fileSize= $_FILES['upload']['size'];

	echo "$name\n";
	echo "$message\n";
	echo "$srcFileName\n";
	echo "$tmpFileName\n";
	echo "$fileSize\n";

	//이미지가 완전 서버에 저장되도록 이동
	$dstFileName= "uploads/".date(YmdHis).$srcFileName;

	if( move_uploaded_file($tmpFileName, $dstFileName) ){
		echo "upload sucess\n";
	}else{
		echo "upload failed\n";
	}

	//저장시간
	$now= date("Y-m-d H:i:s");

	//전달받은 데이터들을 데이터베이스에 저장
	//DB에 접속
	$conn= mysqli_connect("localhost", "mrhi2019", "asdf1234", "mrhi2019");

	//한글깨짐 방지
	mysqli_query($conn, "set names utf8");

	//insert쿼리문 작성
	$sql= "insert into talk(name, msg, filepath, date) values('$name','$message','$dstFileName','$now')";
	$result= mysqli_query($conn, $sql);

	if($result){
		echo "insert success\n";
	}else{
		echo "insert failed\n";
	}

	mysqli_close($conn);

 ?>