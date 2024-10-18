<html>
<head>
	<?php require_once('../../common/config.php');?>

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>LAS_phone_staus_uuid</title>
	<link rel="stylesheet" href="../../assets/css/reset.css">
	<link rel="stylesheet" href="../../assets/css/LAS_phone_status_uuid.css">
</head>
<body>
    <main class="main">
        <section class="phone_status">
            <h2 class="ir_su">현재 휴대폰 상태</h2>

            <!-- Residential-commercial complex  -->
            <div id="downloadBox" class="fillterBtnBox"></div>
            <div id="rst">

            </div>
        </section>
    </main>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="../../assets/js/LAS_phone_status_uuid.js"></script>
    <script>phone_status('phone_status_table_upload/LAS_phone_status_uuid/LAS_phone_status_uuid_A_proc.php');</script>
</body>
</html>