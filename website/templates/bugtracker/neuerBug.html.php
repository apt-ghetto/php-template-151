<!DOCTYPE html>

<html>
<head>
    <link href="/global.css" rel="stylesheet">
</head>
<body>
<div id="header">
<h1>Neuen Bug erstellen</h1>
</div>
<div id="wrapper">
<div id="navigation">
<ul>
<li><a href="/">Heimseite</a></li>
</ul>
</div>
<div id="content">
<form method="POST" action="newBug">
<input type="hidden" name="token" value="<?= $token; ?>" />
<label>Titel:</label><br>
<input type="text" name="titel"/><br>
<label>Beschreibung:</label><br>
<textarea name="description" rows="10" cols="100"></textarea><br><br>
<input type="submit" value="Erstellen" />
</form>
</div>
</div>
</body>
</html>
