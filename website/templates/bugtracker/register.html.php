<!DOCTYPE html>

<html>
<head>
	<link href="global.css" rel="stylesheet">
</head>
<body>
<h1>Registrierung Bugtracker</h1>
<form method="POST" action="newuser">
<label>E-Mail:</label>
<input type="email" name="email" value='<?= (isset($email)) ? $email : ""?>' />
<label>Passwort:</label>
<input type="password"name="password" />
<input type="submit" value="Registrierung" />
</form>
</body>
</html>
