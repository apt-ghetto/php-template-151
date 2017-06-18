<?php

use aptghetto\bugtracker\BugTrackerFactory;

error_reporting(E_ALL);
session_start();

require_once("../vendor/autoload.php");
$conf = parse_ini_file(__DIR__ . "/../config.ini", true);
//var_dump($conf); die();
$factory = new aptghetto\Factory($conf);
$bugtrackerFactory = new BugTrackerFactory($conf);

$url = strtok($_SERVER["REQUEST_URI"], '?');
switch($url) {
    case "/":
        $bugtrackerFactory->getBugController()->showHome();
        break;
    case "/login":
        $ctr = $bugtrackerFactory->getLoginController();
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
        $ctr = $bugtrackerFactory->getLoginController();
        if($_POST["token"] != $_SESSION["token"]) {
            $ctr->showLogin();
        }
        $neuerNutzer = $ctr->createNewUser($_POST);
        $bugtrackerFactory->getMailer()->send(
                Swift_Message::newInstance("Aktivierung Bugtracker")
                ->setFrom(["gibz.module.151@gmail.com" => "apt-ghetto"])
                ->setTo([$neuerNutzer["email"] => $neuerNutzer["nutzername"]])
                ->setBody("Bitte klicken Sie auf http://localhost/activate?token=" . $neuerNutzer['token'] . "&id=" .$neuerNutzer['id'])
                );
        break;
    case "/activate":
        $id = $_GET["id"];
        $token = $_GET["token"];
        $ctr = $bugtrackerFactory->getLoginController();
        $ctr->activateUser($id, $token);
        $ctr->showLogin();
        break;
    case "/forgot":
        $bugtrackerFactory->getLoginController()->showForgot();
        break;
    case "/forgotpw":
        $ctr = $bugtrackerFactory->getLoginController();
        $nutzer = $ctr->reactivateUser($_POST);
        if($nutzer){
            $bugtrackerFactory->getMailer()->send(
                    Swift_Message::newInstance("Aktivierung Bugtracker")
                    ->setFrom(["gibz.module.151@gmail.com" => "apt-ghetto"])
                    ->setTo([$nutzer['email'] => $nutzer['nutzername']])
                    ->setBody("Bitte klicken Sie auf http://localhost/activate?token=" . $nutzer['token'] . "&id=" . $nutzer['id'])
                    );
        } else {
            $bugtrackerFactory->getLoginController()->showForgot();
        }
        break;
    case "/newBug":
        if(isset($_SESSION["email"]) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $bugtrackerFactory->getBugController()->showNewBug();
        } else if (isset($_SESSION["email"]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $bugtrackerFactory->getBugController()->createNewBug($_POST["titel"], $_POST["description"]);
        } else {
            $bugtrackerFactory->getBugController()->showHome();
        }
        break;
    case "/editBug":
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_GET["id"];
            $bugtrackerFactory->getBugController()->editBug($id);
        } else {
            $bugtrackerFactory->getBugController()->saveBug($_POST);
            $bugtrackerFactory->getBugController()->showHome();
        }
        break;
    case "/logout":
        unset($_SESSION["email"]);
        header("Location: /login");
        $bugtrackerFactory->getLoginController()->showLogin();
        break;
    case "/upload":
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $bugtrackerFactory->getBugController()->upload();
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bugtrackerFactory->getBugController()->uploadFile($_FILES);
        }
        break;
    default:
        $matches = [];
        if(preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
            $factory->getIndexController()->greet($matches[1]);
            break;
        }

        if(preg_match("|^/activate/(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
            $token = $matches[1];
            $factory->getIndexController()->greet($matches[1]);
            break;
        }
        echo "Not Found";
}




