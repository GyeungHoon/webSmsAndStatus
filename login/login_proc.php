<?php 
session_start(); 
require_once('../common/config.php');


if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	
	
	
	if (empty($uname)) {
		echo "<script>window.alert('ID 를 입력해주세요.'); history.back(-1)</script>";
	    exit();
	}else if(empty($pass)){
        echo "<script>window.alert('Password 를 입력해주세요.'); history.back(-1)</script>";
	    exit();
	}else{
		// hashing the password
        //$pass = md5($pass);
		// $pass = $pass;
        
		$sql = "SELECT * FROM member WHERE id='$uname' AND psword='$pass'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			
			$row = mysqli_fetch_assoc($result);
            if ($row['id'] === $uname && $row['psword'] === $pass) {
				
            	$_SESSION['id'] = $uname;//$row['id'];
            	$_SESSION['psword'] = $pass; //$row['psword'];//기존은 name이였음
				
				if($_SESSION['id'] == "admin"){
					$sql_login_log = " update `member` set login_log = to_base64(MD5(rand())) where idx = '1' ";
					$result = mysqli_query($conn, $sql_login_log);
					
					$sql_login_select = "select login_log from member where idx = '1' ";
					$result_login_select = mysqli_query($conn, $sql_login_select);
					$rs_login_select = mysqli_fetch_array($result_login_select);
					$url_parm =  $rs_login_select['login_log'];
					
					$url = "../admin_hi/select_query.php?key=$url_parm";
					//$url .= ( $url_parm == '' ? '' : '?' . $url_parm ) ;
					header("Location: $url");
					//echo("<script>location.replace('../admin_hi/select_query.php');</script>");
				}else{
					header("Location: ../../index.php?name=$row[name]");
				}
		        exit();
            }else{
				echo "<script>window.alert('ID 또는 Password 가 일치 하지 않습니다.'); history.back(-1)</script>";
		        exit();
			}
		}else{
			echo "<script>window.alert('ID 또는 Password 가 일치 하지 않습니다.'); history.back(-1)</script>";
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}