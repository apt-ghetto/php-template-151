<!DOCTYPE html>

<html>
<head>
	<link href="global.css" rel="stylesheet">
</head>
<body>
<div id="header">
<h1>Registrierung Bugtracker</h1>
</div>
<div id="wrapper">
<div id="navigation">
<ul>
<li><a href="/">Heimseite</a></li>
<li><a href="login">Login</a></li>
</ul>
</div>
<div id="content">
<form method="POST" action="newuser">
<label>Nutzername:</label><br>
<input type="text" name="nutzername" value='<?= (isset($nutzername)) ? $nutzername : "" ?>' /><br>
<label>E-Mail:</label><br>
<input type="email" name="email" value='<?= (isset($email)) ? $email : ""?>' /><br>
<label>Passwort:</label><br>
<input type="password"name="password" /><br><br>
<input type="submit" value="Registrieren" />
</form>
</div>
</div>
</body>
</html>
