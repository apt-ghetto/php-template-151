<!DOCTYPE html>

<html>
<head>
</head>
<body>
	<h1>Login</h1>
	<form method="POST">
		<label>E-Mail:</label>
		<input type="email" name="email" value='<?= (isset($email)) ? $email : ""?>' />
		<label>Passwort:</label>
		<input type="password"name="password" />
		<input type="submit" value="Login" />
	</form>
</body>
</html>