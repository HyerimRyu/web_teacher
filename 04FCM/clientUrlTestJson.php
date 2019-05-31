<?php 

	header('Content-Type:text/html; charset=utf-8');

	echo "cUrl[ client URL Library ]를 통해 post메세지 보내기..";

	$name= $_POST['name'];
	$message= $_POST['msg'];

	//다른서버에 &name, $message를 post로 전송..
	//연습으로..본인서버에 test.php를 만들어..테스트

	//test.php로 보낼 데이터를 배열로 만들기(연관배열)
	$postData= array("name"=>$name, "msg"=>$message);
	//보낼 데이터 배열을 json으로 변환...
	$postJsonData= json_encode($postData, JSON_UNESCAPED_UNICODE);

	$ch= curl_init();

	//cUrl의 옵션값들 설정

	//1. 요청 URL주소 설정(주소의 풀네임)
	curl_setopt($ch, CURLOPT_URL, "http://mrhi2019.dothome.co.kr/FCM/testJson.php");

	//2. 요청의 결과를 돌려받겠다는 설정
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	//3. POST메소드로 데이터를 보내겠다..는 설정
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postJsonData);

	//4. json으로 요청데이터를 보내려면 .. Header에 
	// json형식의 Content하고 설정해 주어야 함.
	$headers= array(		
		'Content-Type: application/json'
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	//설정값을 기반으로 cUrl실행..
	//결과값을 요청한  URL에서 echo해 준 값
	$result= curl_exec($ch);

	if( $result ){
		echo "성공 : " . $result . "<br/>" ;
	}else{
		echo "실패 : " . curl_error($ch) . "<br/>";
	}

	curl_close($ch);

 ?>