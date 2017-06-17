<!DOCTYPE html>

<html>
<head>
    <link href="/global.css" rel="stylesheet">
</head>
<body>
<div id="header">
<h1>Bug editieren</h1>
</div>
<div id="wrapper">
<div id="navigation">
<ul>
<li><a href="/">Heimseite</a></li>
</ul>
</div>
<div id="content">
<form method="POST" action="editBug" name="bug">
<input type="hidden" name="token" value="<?= $arguments['token']; ?>" />
<input type="hidden" name="id" value="<?= $arguments['id']; ?>" />
<label>Titel:</label><br>
<input type="text" name="titel" value="<?= $arguments['title'] ?>"/><br>
<?= $arguments['title']?>
<label>Beschreibung:</label><br>
<textarea name="description" rows="10" cols="100"><?= $arguments['description'] ?></textarea><br><br>
<label>Wichtigkeit:</label><br>
<select name="importance">
<option <?= $arguments["importance"] == "BLOCKER" ? "selected=\"selected\"" : "" ?>>BLOCKER</option>
<option <?= $arguments["importance"] == "CRITICAL" ? "selected=\"selected\"" : "" ?>>CRITICAL</option>
<option <?= $arguments["importance"] == "HIGH" ? "selected=\"selected\"" : "" ?>>HIGH</option>
<option <?= $arguments["importance"] == "MIDDLE" ? "selected=\"selected\"" : "" ?>>MIDDLE</option>
<option <?= $arguments["importance"] == "LOW" ? "selected=\"selected\"" : "" ?>>LOW</option>
<option <?= $arguments["importance"] == "UNDECIDED" ? "selected=\"selected\"" : "" ?>>UNDECIDED</option>
</select><br>
<label>Status:</label><br>
<select name="status">
<option <?= $arguments["status"] == "NEW" ? "selected=\"selected\"" : "" ?>>NEW</option>
<option <?= $arguments["status"] == "INVALID" ? "selected=\"selected\"" : "" ?>>INVALID</option>
<option <?= $arguments["status"] == "FIXED" ? "selected=\"selected\"" : "" ?>>FIXED</option>
</select>
<br><br>
<input type="submit" value="Speichern" />
</form>
</div>
</div>
</body>
</html>
