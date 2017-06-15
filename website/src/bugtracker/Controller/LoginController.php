<?php
namespace aptghetto\bugtracker\Controller;

use aptghetto\SimpleTemplateEngine;
use aptghetto\bugtracker\Service\BugTrackerLoginService;
// use aptghetto\bugtracker\BugTrackerFactory;

class LoginController {

    private $template;
    private $loginService;


    public function __construct(SimpleTemplateEngine $templ, BugTrackerLoginService $loginService) {
        $this->template = $templ;
        $this->loginService = $loginService;
    }

    public function showLogin() {
        echo $this->template->render("bugtracker/login.html.php", ["token" => $this->createSessionToken()]);
    }

    public function login(array $data) {
        if(!array_key_exists("email", $data) OR !array_key_exists("password", $data) OR !$this->hasValidToken($data["token"])){
            $this->showLogin();
            return;
        }

        if($this->loginService->authenticate($data["email"], $data["password"])) {
            $_SESSION["email"] = $data["email"];
            header("Location: /");
        } else {
            $this->showLogin();
        }
    }

    public function register() {
        echo $this->template->render("bugtracker/register.html.php", ["token" => $this->createSessionToken()]);
    }

    public function createNewUser(array $data) {
        if(isset($data["email"]) && isset($data["password"]) && isset($data["nutzername"])) {
            if(!$this->loginService->createNewUser($data["nutzername"], $data["email"], $data["password"])) {
                echo "Nutzername oder Email existiert schon!";
                $this->register();
            } else {
                echo $this->template->render("bugtracker/danke.html.php");
                return $this->loginService->getUserTokenAndId($data["nutzername"], $data["email"]);
            }
        } else {
            $this->register();
        }
    }

    public function activateUser($id, $token) {
        if(isset($id) && isset($token)) {
            $this->loginService->activateUser($id, $token);
        } else {
            $this->showLogin();
        }
    }

    public function reactivateUser(array $nutzer) {
        if($this->hasValidToken($nutzer["token"])) {
            $name = $nutzer["nutzername"];
            $email = $nutzer["email"];
            $passwort = $nutzer["password"];
            if($this->loginService->reactivateAccount($name, $email, $passwort)) {
                echo $this->danke();
                return $this->loginService->getUserTokenAndId($name, $email);
            }
        }
        return false;
    }

    public function showForgot() {
        echo $this->template->render("bugtracker/forgot.html.php", ["token" => $this->createSessionToken()]);
    }

    private function createSessionToken() {
        $token = bin2hex(random_bytes(100));
        $_SESSION["token"] = $token;

        return $token;
    }

    private function hasValidToken($token) {
        return $token == $_SESSION["token"];
    }

    private function danke() {
        echo $this->template->render("bugtracker/danke.html.php");
    }
}