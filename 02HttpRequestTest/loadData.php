<?php 

	header('Content-Type:text/html; charset=utf-8');

	//DB접속하기..
	$conn= mysqli_connect("localhost", "mrhi2019", "asdf1234", "mrhi2019");//DB서버주소, DB접속아이디, DB접속비번, DB명

	//한글깨짐 방지
	mysqli_query($conn, "set names utf8");

	//테이블의 데이터들을 읽어오는 쿼리문 작성
	$sql="SELECT * FROM board ORDER BY num DESC";
	$result= mysqli_query($conn, $sql);

	//질의한 결과($result)로부터 데이터들 읽어오기..

	//전체 row(행/줄)의 개수
	$rowCount= mysqli_num_rows($result);

	echo ("<!DOCTYPE html>
			<html>
			<head>
				<meta charset='utf-8'>
				<title>게시글 목록</title>
			</head>
			<body>");

	//개수만큼 반복하여 한줄씩 데이터들 읽어오기
	for($i=0; $i<$rowCount; $i++){
		//커서의 위치를 특정 row로 이동
		mysqli_data_seek($result, $i);

		//한줄을 연관배열로..
		$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
		//result type
		// 1.MYSQLI_ASSOC : 연관배열
		// 2.MYSQLI_NUM   : 인덱스배열
		// 3.MYSQLI_BOTH  : 둘다

		//한줄안에 있는 데이터들을 화면에 표시
		$row[message]= nl2br($row[message]);

		echo "<h2>$row[num]</h2>";
		echo "<h3>$row[name]</h3>";
		echo "<p>$row[message]</p>";
		echo "<img src='$row[filepath]' width='50%'>";
		echo "<p>$row[date]</p>";

		echo "<hr/>";
		
	}

	echo ("</body>
		</html>");

	mysqli_close($conn);

 ?>