<?php
namespace aptghetto\bugtracker;

use aptghetto\SimpleTemplateEngine;
use aptghetto\bugtracker\Controller\LoginController;
use aptghetto\bugtracker\Controller\BugController;
use aptghetto\bugtracker\Service\BugTrackerMySQLLoginService;
use aptghetto\bugtracker\Service\BugServiceMySQL;

class BugTrackerFactory {
	
	private $config;
	
	public function __construct(array $config) {
		$this->config = $config;
	}
	
	public function getTemplateEngine() {
		return new SimpleTemplateEngine(__DIR__ . "/../../templates/");
	}
	
	public function getPdo() {
		return new \PDO(
				"mysql:host=" . $this->config["bugtrackerdb"]["host"] . ";dbname=devbugtracker;charset=utf8",
				$this->config["bugtrackerdb"]["user"],
				$this->config["bugtrackerdb"]["password"],
				[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
				);
	}
	
	public function getLoginController() {
		return new LoginController($this->getTemplateEngine(), $this->getLoginService());
	}
	
	public function getBugController() {
		return new BugController($this->getTemplateEngine(), $this->getBugService());
	}
	
	public function getLoginService() {
		return new BugTrackerMySQLLoginService($this->getPdo());
	}
	
	public function getBugService() {
		return new BugServiceMySQL($this->getPdo());
	}
	
	public function getMailer() {
		return \Swift_Mailer::newInstance(
				\Swift_SmtpTransport::newInstance("smtp.gmail.com", 465, "ssl")
				->setUsername("gibz.module.151@gmail.com")
				->setPassword("Pe$6A+aprunu")
				);
	}

}