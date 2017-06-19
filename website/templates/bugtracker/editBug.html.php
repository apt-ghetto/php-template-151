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
<input type="text" name="titel" value="<?= htmlentities($arguments['title']) ?>"/><br>
<label>Beschreibung:</label><br>
<textarea name="description" rows="10" cols="100"><?= htmlentities($arguments['description']) ?></textarea><br><br>
<label>Wichtigkeit:</label><br>
<select name="importance">
<option <?= htmlentities($arguments["importance"]) == "BLOCKER" ? "selected=\"selected\"" : "" ?>>BLOCKER</option>
<option <?= htmlentities($arguments["importance"]) == "CRITICAL" ? "selected=\"selected\"" : "" ?>>CRITICAL</option>
<option <?= htmlentities($arguments["importance"]) == "HIGH" ? "selected=\"selected\"" : "" ?>>HIGH</option>
<option <?= htmlentities($arguments["importance"]) == "MIDDLE" ? "selected=\"selected\"" : "" ?>>MIDDLE</option>
<option <?= htmlentities($arguments["importance"]) == "LOW" ? "selected=\"selected\"" : "" ?>>LOW</option>
<option <?= htmlentities($arguments["importance"]) == "UNDECIDED" ? "selected=\"selected\"" : "" ?>>UNDECIDED</option>
</select><br>
<label>Status:</label><br>
<select name="status">
<option <?= htmlentities($arguments["status"]) == "NEW" ? "selected=\"selected\"" : "" ?>>NEW</option>
<option <?= htmlentities($arguments["status"]) == "INVALID" ? "selected=\"selected\"" : "" ?>>INVALID</option>
<option <?= htmlentities($arguments["status"]) == "FIXED" ? "selected=\"selected\"" : "" ?>>FIXED</option>
</select>
<br><br>
<input type="submit" value="Speichern" />
</form>
</div>
</div>
</body>
</html>
