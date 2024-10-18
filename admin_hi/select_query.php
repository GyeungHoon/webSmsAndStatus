<html>
	<head>
		<title>ADMIN</title>
		<link rel="stylesheet" href="/assets/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/select_query.css">
		<?php require_once('../common/config.php');?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<?php
			
		//$sql = "SELECT * From nowstate where idx = '1' ";
		//$result = mysqli_query($conn, $sql);
		//$rs = mysqli_fetch_array($result);  
		  $sql = "SELECT * from member where idx != 1";
		  $result = mysqli_query($conn, $sql);
		  $totalUser=0;
		  $sql_login_chk = "select * from member where idx = '1' ";
		  $result_login_chk = mysqli_query($conn, $sql_login_chk);
		  $rs_login_chk = mysqli_fetch_array($result_login_chk);
		  
		if( $_GET['key'] == '' ){
			echo '<script type="text/javascript">'; 
			echo 'alert("비정상적인 로그인 시도");'; 
			echo 'window.location.href = "../login/login.php";';
			echo '</script>';
	    }
		    
		if ( $_GET['key'] != $rs_login_chk['login_log'] ){
			echo '<script type="text/javascript">'; 
			echo 'alert("비정상적인 로그인 시도");'; 
			echo 'window.location.href = "../login/login.php";';
			echo '</script>';
		 }
		 
		?>
	</head>
	<body>
		<main>
			<section class="userManagement">
				<h2 class="ir_su">고객관리박스</h2>
				<div class="ufSelect">
					<h3 class="ir_su">고객 및 플랫폼 선택박스</h3>
					<form action="#">
						<label class="ir_su" for="user">사용자목록</label>
						<select name="user" id="user">
							<option selected disabled>고객을 선택해주세요.</option>
						<?php  while($rs = mysqli_fetch_array($result)) { 
							if($totalUser <= count($rs)){
								$totalUser++;
							}
						?>
							<option value="<?=$rs['idx']?>"><?=$rs['name']?>/<?=$rs['id']?></option>
						<?php } ?>
						</select>

						<label class="ir_su" for="type">플랫폼목록</label>
						<select name="type" id="type">
							<option selected disabled>플랫폼을 선택해주세요.</option>
							<option value="라스">라스 문자</option>
							<option value="네이버">네이버 문자</option>
							<option value="당근마켓">당근마켓 문자</option>
							<option value="카카오톡">카카오톡 문자</option>
							<option value="라인">라인 문자</option>
							<option value="텔레그램">텔레그램 문자</option>
							<option value="밴드">밴드 문자</option>
							<option value="구글">구글 문자</option>
							<option value="리니지">리니지 문자</option>
							<option value="에오스">에오스 문자</option>
						</select>
						<button type="button" onclick="search();" >완료</button>			
					</form>
				</div>
				<div class="userAdd">
					<button type="button" onClick="location.href='/admin_hi/signup.php'" > 고객등록</button>							
				</div>
				<div class="userLogout">
					<button type="button" onClick="location.href='/admin_hi/select_query_proc.php?hCode=logout'" > 로그아웃</button>			
				</div>
				<div class="totalUser">
					<span>현재 등록된 고객수 : <?=$totalUser?></span>
				</div>
			</section>
			<section class="userList">
				<h2 class="ir_su">고객 및 플랫폼 목록</h2>
				<?php 
					$sql = "SELECT * from member where idx != 1";
					$result = mysqli_query($conn, $sql);
					$userNum = 0;
				?>
				<ul>
				<?php  while($rs = mysqli_fetch_array($result)) { 
					if($userNum <= count($rs)){
						$userNum++;
					}
				?>		
					<li><?=$userNum?>. <span><?=$rs['name']?></span> 고객 ( <?=$rs['id']?> ) 현재 <span><?=$rs['state']?></span> 만 보여지는 중 <span class="userIdx"></span></li>
					<button type="button" onClick="location.href='/admin_hi/select_query_proc.php?hCode=Delete&idx=<?=$rs['idx']?>'" >고객삭제</button>
					<hr />	
				<?php } ?>
				</ul>
			</section>
		</main>
		<script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="/assets/js/select_query.js"></script>
	</body>
</html>
