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
			echo $this->template->render("bugtracker/login.html.php", ["email" => $data["email"]]);
		}
		echo "Process Login";
	}
}