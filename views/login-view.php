<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div>
		<form action="../controllers/login.php" method="post">
		<label for="email">Email</label>
		<input type="email" name="email">
		<label for="password">Password</label>
		<input type="password" name="password">
		<button>Login</button>
		</form>
	</div>
	<div style="margin-top: 25px;">
	<form  action="../controllers/register.php" method="post">
		<label for="email">Email</label>
		<input type="email" name="email">
		<label for="password">Password</label>
		<input type="password" name="password">
		<button>Register</button>
	</form>
	</div>
</body>
</html>