<!DOCTYPE html>
<html>
<head>
    <link href="/global.css" rel="stylesheet">
</head>
<body>
<div id="header">
<h1>Heimseite Bugtracker</h1>
</div>
<div id="wrapper">
<div id="navigation">
<ul>
<?php if(isset($_SESSION["email"])){
    echo "<li><a href=\"logout\">Logout</a></li>";
    echo "<li><a href=\"newBug\">Neuer Bug</a></li>";
    echo "<br>";
} else {
    echo "<li><a href=\"login\">Login</a></li>";
    echo "<li><a href=\"register\">Registrierung</a></li>";
}
?>
</ul>
</div>
<div id="content">
<table border="1">
<tr>
<th>Bugnummer</th>
<th>Wichtigkeit</th>
<th>Status</th>
<th>Titel</th>
<th>Beschreibung</th>
<th>Editieren</th>
</tr>
<?php
foreach($arguments AS $row) {
    echo "<tr>";
    echo "<td>" . htmlentities($row['id']) . "</td>";
    echo "<td>" . htmlentities($row['importance']) . "</td>";
    echo "<td>" . htmlentities($row['status']) . "</td>";
    echo "<td>" . htmlentities($row['title']) . "</td>";
    echo "<td>" . htmlentities($row['description']) . "</td>";
    if (isset($_SESSION["email"])) {
        echo "<td><a href=\"editBug?id=" . htmlentities($row['id']) . "\">Edit</a>";
    } else {
        echo "<td><a href=\"login\">Einloggen</a></td>";
    }
    echo "</tr>";
}

?>
</table>
</div>
</div>
</body>
</html>