<?php 

	header('Content-Type:text/html; charset=utf-8');

	//Request 로 요청된 값들을 가져오기
	$name= $_POST['name'];
	$message= $_POST['msg'];
	$now= date("Y-m-d A h:i:s");

	//$message에 특수문자 중 (' 작은따옴표 같은 것이 있으면 문자열의 종료로 보고 잘못처리함 예) I'm student)
	//이때 ' 표시가 되게 하려면 역슬래쉬(\)표시를 해주어야 함.
	//다행이...이를 해주는 메소드가 있음.
	$message= addslashes($message);
	//참고로..만약 역슬래쉬를 제거하고 싶다면..
	//$message= stripslashes($message);

	//파일받기
	$file= $_FILES['upload'];
	//$file은 사실 파일에 대한 정보를 가지고 있는 배열
	$srcFileName= $file['name'];
	$fileType= $file['type'];
	$fileSize= $file['size'];
	$tmpFileName= $file['tmp_name'];

	//중복되지 않는 글짜를 만들기 위해
	$fileName= date(YmdHis).".jpg";//"20190123102645"
	$dstFileName= "uploads/".$fileName;

	//브라우저에 출력
	echo "이름 : $name <br/>";
	echo "메세지 : $message <br/>";
	echo "원본파일명 : $srcFileName <br/>";
	echo "임시파일명 : $tmpFileName <br/>";
	echo "최종파일명 : $dstFileName <br/>";

	//임시경로에 있는 파일을 최정목적지로 이동
	$result= move_uploaded_file($tmpFileName, $dstFileName);
	if($result){
		echo "upload success<br/>";
	}else{
		echo "upload fail<br/>";
	}

	//MySQL DB에 접속하여 쿼리작업하기..
	//DB서버의 주소, DB접속 ID, 패스워드, db파일명
	//"localhost":본인 PC의 도메인 주소
	$conn= mysqli_connect("localhost", "mrhi2019", "asdf1234", "mrhi2019");


	//한글깨짐 방지
	mysqli_query($conn, "set names utf8");

	//데이터를 삽입(insert) : insert 쿼리문 작성
	$sql= "insert into board(name, message, filepath, date) values('$name','$message','$dstFileName','$now')";
	$result= mysqli_query($conn, $sql);

	if($result){
		echo "insert success";
	}else{
		echo "insert failed";
	}

	mysqli_close($conn);

 ?>