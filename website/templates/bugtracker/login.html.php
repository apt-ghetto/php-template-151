
<!DOCTYPE html>

<html>
<head>
    <link href="/global.css" rel="stylesheet">
</head>
<body>
<div id="header">
<h1>Login Bugtracker</h1>
</div>
<div id="wrapper">
<div id="navigation">
<ul>
<li><a href="/">Heimseite</a></li>
<li><a href="register">Registrierung</a></li>
</ul>
</div>
<div id="content">
<form method="POST">
<input type="hidden" name="token" value="<?= $token; ?>" />
<label>E-Mail:</label><br>
<input type="email" name="email" value='<?= (isset($email)) ? $email : ""?>' /><br>
<label>Passwort:</label><br>
<input type="password"name="password" /><br><br>
<input type="submit" value="Login" />
</form>
</div>
</div>
</body>
</html>
