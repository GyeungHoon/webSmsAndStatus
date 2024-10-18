<?php
 require_once('../common/config.php');
 
 
 if($_POST['hCode'] ?? null == 'Insert'){
	$sql = "INSERT INTO `member` (id, psword,name,create_date) 
		VALUES ('$_POST[uname]','$_POST[password]','$_POST[name]', now())" ;
		
 }else if($_GET['hCode'] ?? null == 'Delete'){
	 $sql = "delete from member where idx = '$_GET[idx]' ";

 }else if($_GET['hCode'] ?? null == 'logout'){
	 $sql = "update `member` set login_log = '' where idx = '1' ";
	 
	 echo "<script>alert(\"로그아웃 되었습니다.\");";
	 echo 'window.location.href = "/login/login.php";';
	 echo "</script>";
	 
 }else{
	 if($_GET['val'] == '라스'){
		 $sql = "UPDATE member set state = '라스' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '네이버'){
		 $sql = "UPDATE member set state = '네이버' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '당근마켓'){
		 $sql = "UPDATE member set state = '당근' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '카카오톡'){
		 $sql = "UPDATE member set state = '카카오톡' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '라인'){
		$sql = "UPDATE member set state =  'LINE' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '텔레그램'){
		$sql = "UPDATE member set state =  'Telegram code' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '밴드'){
		$sql = "UPDATE member set state =  'BAND' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '구글'){
		$sql = "UPDATE member set state =  'Google' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '리니지'){
		$sql = "UPDATE member set state =  'NCSOFT' where idx = '$_GET[idx]' " ;
	 }else if($_GET['val'] == '에오스'){
		$sql = "UPDATE member set state =  '에오스' where idx = '$_GET[idx]' " ;
	 }
	 
	 
 }

 $result = mysqli_query($conn, $sql);
 
	echo "<script>alert(\"완료 되었습니다.\");";
	echo "let UID = sessionStorage.getItem('userId');";
	echo 'window.location.href = "/admin_hi/select_query.php?key=";';
	// echo $_SESSION['userName'];
	// echo $_SESSION['userPw'];

	echo "</script>";
	
	

?>