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
        echo $this->template->render("bugtracker/editBug.html.php", $bug);
    }

    public function saveBug(array $bug) {
        $this->bugService->saveBug($bug);
    }

    private function createSessionToken() {
        $token = bin2hex(random_bytes(100));
        $_SESSION["token"] = $token;

        return $token;
    }

    private function hasValidToken($token) {
        return $token == $_SESSION["token"];
    }
}