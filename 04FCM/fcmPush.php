<?php 

	header('Content-Type:application/json; charset=utf-8');

	$name= $_POST['name'];
	$msg= $_POST['msg'];

	//firebase cloud meesage서버에 push요청하기!!!
	//다른 서버에 요청하려면..cUrl 라이브러리를 사용함.

	//FCM서버로 보낼 데이터
	//1. 메세지를 받을 기기의 고유 식별값(token) 배열
	$tokens= array(
		'dtixxGjE4GI:APA91bEMTIWqA8LYHcwA_4R3mL6XX_FOgm6zp86tD09bxvY9bWXUySCJwiJr_Dh4BWVvg5PggtBbH9Nx6bQ76A13jK3LvwkhAh4UVyEbIHLArubZYxd6g5T6M_e1PNARSLgV3B1hchej',
		'cMX-cw_McKA:APA91bEI7UggOVSTIHJyDTVHgF9zvfZQH89YvOCyh55ViIK7Kwrv7G5W2sicbMSCnaj0ZwV-3xo7M70_jVRJnugTDhtPRa62e1eKkK1IwvXLARsH4dfrFwh-fgV-hMoEhrADa04d5uJe'
	);

	//2. 보낼 메세지
	$datas= array(
		"name"=>$name,
		"msg"=>$msg
	);

	$postData= array(
		'registration_ids'=> $tokens,
		'data'=>$datas
	);
	//FCM서버는 데이터를 json으로 주고받음..
	//연관배열을 json문자열로 변환
	$postData= json_encode($postData, JSON_UNESCAPED_UNICODE);

	//json으로 데이터를 보내려면..Header에 json형식의
	//Content라고 설정 해 주어야 함.
	//1. FCM 서버쪽으로 보내려면.. 본인 웹 서버(dothome서버: 3 party server)에서 FCM서버에게 기능사용을 요청하기 위해 발급받은 '서버키' 필요함
	$serverKey='AAAAmvnuQw0:APA91bHJc57rVU_pI_ZrUZ99GJG9gBb-ZyKIZwLbHJxFtzYR2Nmt9YJ6-w6EjwVM0lyEQD0Npboe-CSMcfDYqnpkcsIL0mweRd57Yi6tlyLn0xcbSXduUqJgcs4gFNqLGcntlDd8YRUT';

	$headers= array(
		'Authorization:key = '.$serverKey,
		'Content-Type:application/json'
	);

	//cUrl 라이브러리 사용.
	$ch= curl_init();

	//cUrl설정들
	//1. 요청 URL [firebase의 서버 주소]
	$fcmUrl='https://fcm.googleapis.com/fcm/send';
	curl_setopt($ch, CURLOPT_URL, $fcmUrl);

	//2. 요청 결과를 돌려받겠다는 설정
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	//3. Post메소드로 데이터 전송하는 설정
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

	//4. Header정보..설정
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	//설정을 기반으로 cUrl요청 실행!!
	$result=curl_exec($ch);
	if($result === false){
		die('curl failed!!!');
	}

	curl_close($ch);

 ?>