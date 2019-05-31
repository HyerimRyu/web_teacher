<?php 

	header('Content-Type:text/html; charset=utf-8');

	$conn= mysqli_connect("localhost", "mrhi2019", "asdf1234", "mrhi2019");

	mysqli_query($conn, "set names utf8");

	$sql= "select * from talk";
	$result= mysqli_query($conn, $sql);

	//받은 결과의 총 줄수:레코드개수(row개수 : item의 개수)
	$row_num= mysqli_num_rows($result);

	for($i=0; $i<$row_num; $i++){
		$row= mysqli_fetch_array($result, MYSQLI_ASSOC);//한줄씩 읽어오기
		echo "$row[num]&$row[name]&$row[msg]&$row[filepath]&$row[date];";
	}

	mysqli_close($conn);
 ?>