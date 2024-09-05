<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div>
		<form action="../Router.php" method="post">
		<input type="hidden" name="action" value="login_user">
		<label for="email">Email</label>
		<input type="email" name="email">
		<label for="password">Password</label>
		<input type="password" name="password">
		<button>Login</button>
		</form>
	</div>
	<div style="margin-top: 25px;">
	<form  action="../Router.php" method="post">
	<input type="hidden" name="action" value="register_user">
		<label for="email">Email</label>
		<input type="email" name="email">
		<label for="password">Password</label>
		<input type="password" name="password">
		<button>Register</button>
	</form>
	</div>
</body>
</html>