<!DOCTYPE html>

<html>
<head>
    <link href="global.css" rel="stylesheet">
</head>
<body>
<div id="header">
<h1>Passwort vergessen?</h1>
</div>
<div id="wrapper">
<div id="navigation">
<ul>
<li><a href="/">Heimseite</a></li>
<li><a href="login">Login</a></li>
</ul>
</div>
<div id="content">
<p>Bitte den Nutzernamen, die genutzte E-Mail-Adresse und das neue Passwort angeben.</p>
<p>Anschliessend wird eine Aktivierungsmail verschickt.</p>
<form method="POST" action="forgotpw">
<input type="hidden" name="token" value="<?= $token; ?>" />
<label>Nutzername:</label><br>
<input type="text" name="nutzername" value='<?= (isset($nutzername)) ? $nutzername : "" ?>' /><br>
<label>Genutzte E-Mail:</label><br>
<input type="email" name="email" value='<?= (isset($email)) ? $email : ""?>' /><br>
<label>Neues Passwort:</label><br>
<input type="password" name="password" /><br><br>
<input type="submit" value="Neues Passwort verwenden" />
</form>
</div>
</div>
</body>
</html>
