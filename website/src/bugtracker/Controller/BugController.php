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
		echo $this->template->render("bugtracker/home.html.php", $this->bugService->getAllBugs());
	}
	
	public function showNewBug() {
		echo $this->template->render("bugtracker/neuerBug.html.php");
	}
	
	public function createNewBug($titel, $description) {
		$this->bugService->createNewBug($titel, $description);
		$this->showHome();
	}
	
	public function editBug($id) {
		$bug = $this->bugService->getBugById($id);
// 		var_dump($bug); die;
		echo $this->template->render("bugtracker/editBug.html.php", $bug);
	}
}