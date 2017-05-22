<?php

use aptghetto\bugtracker\BugTrackerFactory;

error_reporting(E_ALL);
session_start();

require_once("../vendor/autoload.php");
$conf = parse_ini_file(__DIR__ . "/../config.ini", true);
//var_dump($conf); die();
$factory = new aptghetto\Factory($conf);
$bugtrackerFactory = new BugTrackerFactory($conf);

switch($_SERVER["REQUEST_URI"]) {
	case "/":
		$bugtrackerFactory->getLoginController()->showLogin();
		break;
	case "/login":
		$ctr = $factory->getLoginController();
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			$ctr->showLogin();
		} else {
			$ctr->login($_POST);
		}		
		break;
	case "/bt":
		$ctr = $bugtrackerFactory->getLoginController();
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			$ctr->showLogin();
		} else {
			$ctr->login($_POST);
		}
		break;
	case "/register":
		$ctr = $bugtrackerFactory->getLoginController();
		if($_SERVER['REQUEST_METHOD'] == 'GET') {
			$ctr->register();
		}
		
		break;
	case "/newuser":
		$bugtrackerFactory->getLoginController()->createNewUser($_POST);
		break;
	default:
		$matches = [];
		if(preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
			$factory->getIndexController()->greet($matches[1]);
			break;
		}
		echo "Not Found";
}



