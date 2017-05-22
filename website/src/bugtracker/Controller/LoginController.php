<?php
namespace aptghetto\bugtracker\Controller;

use aptghetto\SimpleTemplateEngine;
use aptghetto\bugtracker\Service\BugTrackerLoginService;

class LoginController {
	
	private $template;	
	private $loginService;
	
	
	public function __construct(SimpleTemplateEngine $templ, BugTrackerLoginService $loginService) {
		$this->template = $templ;
		$this->loginService = $loginService;
	}
	
	public function showLogin() {
		echo $this->template->render("bugtracker/login.html.php");
	}
	
	public function login(array $data) {
		if(!array_key_exists("email", $data) OR !array_key_exists("password", $data)){
			$this->showLogin();
			return;
		}
		
		if($this->loginService->authenticate($data["email"], $data["password"])) {
			$_SESSION["email"] = $data["email"];
			header("Location: /");
		} else {
			echo $this->template->render("bugtracker/home.html.php", ["email" => $data["email"]]);
		}
	}
	
	public function register() {
		echo $this->template->render("bugtracker/register.html.php");
	}
	
	public function createNewUser(array $data) {
		if(isset($data["email"]) && isset($data["password"])) {
			$this->loginService->createNewUser($data["email"], $data["password"]);
		} else {
			$this->register();
		}
	}
	
	/*
	 * $password = "my-secret-pw";
	 * $hash = password_hash($password, PASSWORD_DEFAULT);
	 * echo "Hash: " . $hash . "<br/>";
	 * echo "Is true?";			password_verify
	 *
	 */
}