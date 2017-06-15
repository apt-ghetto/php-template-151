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

    /*
     * $password = "my-secret-pw";
     * $hash = password_hash($password, PASSWORD_DEFAULT);
     * echo "Hash: " . $hash . "<br/>";
     * echo "Is true?";            password_verify
     *
     */

}