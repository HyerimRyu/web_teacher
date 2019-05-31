<?php 

	header('Content-Type:text/html; charset=utf-8');

	//데이터베이스 접속
	$conn= mysqli_connect("localhost", "mrhi2019", "asdf1234", "mrhi2019");

	mysqli_query($conn, "set names utf8");

	$sql="select * from talk";
	$result= mysqli_query($conn, $sql);

	//결과의 총 레코드 수(row의 개수)
	$row_num= mysqli_num_rows($result);

	$rows= array();
	for($i=0; $i<$row_num; $i++){
		//한줄을 배열로 가져오기
		$row= mysqli_fetch_array($result, MYSQLI_ASSOC);//연관배열

		$rows[$i]= $row;
	}

	//$rows는 2차원배열임...
	$jsonData= json_encode($rows);
	echo $jsonData;

	mysqli_close($conn);

 ?>