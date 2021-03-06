<?php

error_reporting(E_ALL);
session_start();

require_once("../vendor/autoload.php");
$conf = parse_ini_file(__DIR__ . "/../config.ini", true);
//var_dump($conf); die();
$factory = new aptghetto\Factory($conf);

switch($_SERVER["REQUEST_URI"]) {
	case "/":
		$factory->getIndexController()->homepage();
		break;
	case "/test/upload":
		if(file_put_contents(__DIR__ . "/../../upload/test.txt", "Mein erster Upload")) {
			echo "It worked";
		} else {
			echo "Error happened";
		}
		break;
	case "/login":
		$ctr = $factory->getLoginController();
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			$ctr->showLogin();
		} else {
			$ctr->login($_POST);
		}		
		break;
	default:
		$matches = [];
		if(preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
			$factory->getIndexController()->greet($matches[1]);
			break;
		}
		echo "Not Found";
}

