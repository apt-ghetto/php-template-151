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
	echo "<li><a href=\"login\">Login<a/></li>";
	echo "<li><a href=\"register\">Registrierung</a></li>";
}
?>

</ul>
</div>
<div id="content">
<p>test</p>
</div>
</div>
</body>
</html>