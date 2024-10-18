<?php
	
	//변수 저장
	$message = "[Web발신] <#> [인증번호:238603] 카카오톡에서 보낸 인증번호입니다. (타인 노출/전달 금지) iL5y9j8vHd2";
	$date = "20211121 17:06:00";
	$from = "01086537378";
	$to = "01011111234";
    $androidId = "testtttt";
	
	
	
	
	
	//메시지함수에서 인증번호 시작자리 찾기, 찾은 후 +6자리 추출, ATH_NO변수에 넣기
	//$ATH_NO = 
	
	//echo strpos($message,"인증번호:")."번째";
	//
	
	//echo substr($message,strpos($message,":")+1,6);


	$passcode_temp1 = strpos($message,"인증번호:");
	$passcode_temp2 = substr($message,$passcode_temp1,20);
	$passcode = preg_replace("/[^0-9]/", "",$passcode_temp2);
	// echo $passcode;

	
	//DB INSERT
    // DB 연결 정보
    $db_host = "primedb.sldb.iwinv.net";
    $db_user = "admin_web_sms";
    $db_pass = "DBVMware1!";
    $db_name = "WEB_SMS_IN";

    // DB 연결
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	//이유는 모르겠으나 컬럼명까지 작성하면 Insert가 안됨...;; from컬럼명에 뭔가 제약이 있는건지..?

    if (mysqli_connect_errno()) {
        echo "DB 연결 실패: " . mysqli_connect_error();
        exit;
    }

    echo "체크포인트<br>" ;


	$sql  = "
	INSERT INTO maintable (
        date,
        `from`,
        `to`,
        message,
        ATH_NO,
        androidId
    ) VALUES (
        '$date',
        '$from',
        '$to',
        '$message',
		'$passcode',
		'$androidId'
    )";
	$result = mysqli_query($conn, $sql);
	if ($result === false) {
        echo "쿼리 오류: " . mysqli_error($conn);
    } else {
        echo "데이터가 성공적으로 입력되었습니다.";
    }


    // DB 연결 종료
    mysqli_close($conn);

?>



