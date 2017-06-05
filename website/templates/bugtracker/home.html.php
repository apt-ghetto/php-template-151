
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
<th></th>
</tr>
<?php 
foreach($arguments AS $row) {
	echo "<tr>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td>" . $row['importance'] . "</td>";
	echo "<td>" . $row['status'] . "</td>";
	echo "<td>" . $row['title'] . "</td>";
	echo "<td>" . $row['description'] . "</td>";
	if (isset($_SESSION["email"])) {
		echo "<td><a href=\"editBug?id=" . $row['id'] . "\">Edit</a>";
	} else {
		echo "<td>Editieren nicht möglich</td>";
	}
	echo "</tr>";
}

?>
</table>
</div>
</div>
</body>
</html>