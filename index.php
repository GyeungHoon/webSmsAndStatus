<html>
<head>
	<?php require_once('common/config.php');?>
		<?php
			if($_GET['name'] == ''){
				echo "
				<script>
					window.alert('로그인 후 이용해주세요');
					location.href = 'https://oa1sms.iwinv.net/login/login.php';
					
				</script>";
			}
		?>
		<!-- //location.href = 'https://oa1sms.iwinv.net/login/login.php'; -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>SMS INBOUND</title>
	<link rel="stylesheet" href="/assets/css/reset.css">
	<link rel="stylesheet" href="/assets/css/smsinbound.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
	<div class="websms">

        <!-- <input type="hidden" id="name" name="name" value="</*?=$_GET['name']?*/>">  -->
         <!-- name 전달하는 부분 위 코드수정 -->
          
        <input type="hidden" id="name" name="name" value="<?= $_GET['name'] ?>">

		<!-- <h2>SMS INBOUND</h2>
		<div class="rst01">
			<input class="search_input" type="text" id="search_input" name="search_input" placeholder="검색어를 입력하세요.">
			<input type="hidden" id="name" name="name" value="</*?=$_GET['name']?*/>"> 
            <input type="hidden" id="name" name="name" value="<?= $_GET['name'] ?>">
			<input class="search_bt" type="button" id="search_bt" value="Search">
			<button class="search_bt" type="submit" id="search_bt" value="Search">
			<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
			</button>
		</div> -->
		<h2 class="ir_su">SMS INBOUND</h2>
		<div class="rst02">
			<table>
				<thead>
					<tr>
						<th>수신시간</th>
						<th>보낸사람</th>
						<th>받은사람</th>
						<th>기기명</th>
						<th>문자내용</th>
					</tr>
				</thead>
				<tbody id="rst">
				</tbody>
			</table>
		</div>
	</div>
	<script src="/assets/js/indexFunctions.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>fun_load();</script>
</body>
</html>