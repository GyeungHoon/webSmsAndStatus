<html>
<head>
	<?php require_once('../../common/config.php');?>

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>phone_staus_uuid</title>
	<link rel="stylesheet" href="../../assets/css/reset.css">
	<link rel="stylesheet" href="../../assets/css/phone_status_uuid.css">

</head>
<body>
    <main class="main">
        <section class="phone_status">
            <h2 class="ir_su">현재 휴대폰 상태</h2>

            <!-- Residential-commercial complex  -->
            <div class="fillterBtnBox"><button onclick="phone_status('phone_status_table_upload/phone_status_uuid/phone_status_uuid_A_proc.php');">A</button><button onclick="phone_status('phone_status_table_upload/phone_status_uuid/phone_status_uuid_B_proc.php');">B</button><button onclick="phone_status('phone_status_table_upload/phone_status_uuid/phone_status_uuid_P_proc.php');">P</button></div>
            <div id="rst">

            </div>
        </section>
    </main>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/phone_status_uuid.js"></script>
    <script>phone_status('phone_status_table_upload/phone_status_uuid/phone_status_uuid_A_proc.php'); </script>
</body>
</html>