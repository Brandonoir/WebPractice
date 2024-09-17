<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/AuthPage.css">
    <title>Document</title>
</head>
<body>
	<div class="auth-form">
		<h1>Register</h1>
		<div class="register-form" style="margin-top: 25px;">
			<form  action="../Router.php" method="post">
				<input type="hidden" name="action" value="register_user">
				<article class="auth-field">
					<label for="email" class="email-label">Email</label>
					<input type="email" name="email" class="email-input">
				</article>
				<br>	
				<article class="auth-field">
				<label for="password" class="password-label">Password</label>
				<input type="password" name="password" class="password-input">
				</article>
				<br>
				<button>Register</button>
			</form>
		</div>
		<div class="login-redirect">
			<a href="login.view.php">Login</a>
		</div>
	</div>
</body>
</html>