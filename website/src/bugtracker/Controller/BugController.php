<?php
namespace aptghetto\bugtracker\Controller;

use aptghetto\SimpleTemplateEngine;
use aptghetto\bugtracker\Service\BugService;
// use aptghetto\bugtracker\BugTrackerFactory;

class BugController {
	private $template;
	private $bugService;
	
	public function __construct(SimpleTemplateEngine $templ, BugService $bugService) {
		$this->template = $templ;
		$this->bugService = $bugService;
	}
	
	public function showHome() {
		echo $this->template->render("bugtracker/home.html.php");
	}
}