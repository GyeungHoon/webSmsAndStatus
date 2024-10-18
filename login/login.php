
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/login.css">
</head>
<body>
	<main>
		<form action="login_proc.php" method="post">
			<h2>LOGIN</h2>
			<?php if (isset($_GET['error'])) { ?>
				<p class="error"><?php echo $_GET['error']; ?></p>
			<?php } ?>
			<label>User ID</label>
			<input type="text" name="uname" placeholder="User Name"><br>

			<label>Password</label>
			<input type="password" name="password" placeholder="Password"><br>

			<button type="submit">Login</button>
		<!--<a href="signup.php" class="ca">Create an account</a> -->
		</form>
	</main>
</body>
</html>
