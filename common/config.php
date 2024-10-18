<?php
	$servername = "primedb.sldb.iwinv.net";
	$dbname = "IC_WEB_SMS_IN";
	$user = "admin_web_sms";
	$password = "DBVMware1!";
    try {
		$connect = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $user, $password);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "서버와의 연결 성공!";
    } catch(PDOException $ex)  {
        //echo "서버와의 연결 실패! : ".$ex->getMessage()."<br>";
    }

	$conn = mysqli_connect($servername, $user, $password, $dbname);
	//$conn = mysqli_connect("127.0.0.1", "root", "" , "sms");
	//$sql = "SELECT * FROM maintable";
	//$result = mysqli_query($connect, $sql);
	//$connect->close();

?>