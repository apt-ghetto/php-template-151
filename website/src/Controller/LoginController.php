<?php

namespace aptghetto\Controller;

use aptghetto\SimpleTemplateEngine;
use aptghetto\Service\LoginService;

class LoginController 
{
  /**
   * @var aptghetto\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /** 
   * @var LoginService
   */
  private $loginService;
  
  /**
   * @param aptghetto\SimpleTemplateEngine
   * @param \PDO
   */
  public function __construct(SimpleTemplateEngine $template, LoginService $loginService)
  {
     $this->template = $template;
     $this->loginService = $loginService;
  }
  
  public function showLogin() {
  	echo $this->template->render("login.html.php");
  }
  
  public function login(array $data) {
  	if(!array_key_exists("email", $data) OR !array_key_exists("password", $data)) {
  		$this->showLogin();
  		return;
  	}
  	
  	if( $this->loginService->authenticate($data["email"], $data["password"])) {
  		$_SESSION["email"] = $data["email"];
  		header("Location: /");
  	} else {
  		echo $this->template->render("login.html.php", ["email" => $data["email"]]);
  	}
  	echo "Process Login";
  }
}
