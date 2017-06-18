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
</ul>
</div>
<div id="content">
<form method="POST" action="upload" enctype="multipart/form-data">
<p>Nur txt-Dateien sind erlaubt.</p>
<input type="hidden" name="token" value="<?= $token; ?>" />
<input type="file" name="datei" /><br>
<input type="submit" value="Obsi laden" />
</form>
</div>
</div>
</body>
</html>
