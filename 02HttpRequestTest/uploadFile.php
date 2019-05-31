<?php 

	
	$file= $_FILES['upload'];

	// $file변수는 파일에 대한 여러값을 가지고 있음.
	//그래서ㅜ 사실은 배열변수임.

	$fileName= $file['name'];
	$fileType= $file['type'];
	$fileSize= $file['size'];

	//기본적으로 업로드된 파일은 임시저장소에 저장되어 있음.
	//그곳의 경로와 파일명을 얻어오기..
	$tmpFileName= $file['tmp_name'];

	echo "$fileName <br/>";
	echo "$fileType <br/>";
	echo "$fileSize <br/>";
	echo "$tmpFileName <br/>";

	//임시파일에 저장되어 있는 이미지파일을 
	//우리가 원하는 목적지점에 저장하도록...

	//파일의 저장될 경로와 파일명.확장자
	//중복된 이름이 안되도록... 현재날짜를 기반으로
	//저장활 파일명 정하기

	$now= date(Ymdhis);//"20190128144530"
	$dstFileName= "uploads/" . $now . ".jpg"; //php에서 문자열 덧셈은 . 입니다


	echo "$dstFileName<br/>";

	//임시저장소에 있는 이미지파일을 목적하는 경로의 위치로 이동시키기
	$result= move_uploaded_file($tmpFileName, $dstFileName);

	if($result){
		echo "success";
	}else{
		echo "failed";
	}




 ?>