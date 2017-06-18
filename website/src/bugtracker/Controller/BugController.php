<?php
namespace aptghetto\bugtracker\Controller;

use aptghetto\SimpleTemplateEngine;
use aptghetto\bugtracker\Service\BugService;

class BugController {
    private $template;
    private $bugService;
    private $sessionCtr;

    public function __construct(SimpleTemplateEngine $templ, BugService $bugService, SessionController $sessionCtr) {
        $this->template = $templ;
        $this->bugService = $bugService;
        $this->sessionCtr = $sessionCtr;
    }

    public function showHome() {
        echo $this->template->render("bugtracker/home.html.php", $this->bugService->getAllBugs());
    }

    public function showNewBug() {
        echo $this->template->render("bugtracker/neuerBug.html.php", ["token" => $this->sessionCtr->createSessionToken()]);
    }

    public function createNewBug($titel, $description) {
        $this->bugService->createNewBug($titel, $description);
        $this->showHome();
    }

    public function editBug($id) {
        $token = array("token" => $this->sessionCtr->createSessionToken());
        $array = array_merge($this->bugService->getBugById($id), $token);
        echo $this->template->render("bugtracker/editBug.html.php", $array);
    }

    public function saveBug(array $bug) {
        if($this->sessionCtr->hasValidToken($bug['token'])) {
            $this->bugService->saveBug($bug);
        } else {
            unset($_SESSION['email']);
        }
    }

    public function upload() {
        echo $this->template->render("bugtracker/upload.html.php", ["token" => $this->sessionCtr->createSessionToken()]);
    }

    public function uploadFile(array $files) {
        if('txt' == strtolower(pathinfo($files['datei']['name'], PATHINFO_EXTENSION))) {
            move_uploaded_file($files['datei']['tmp_name'], '../../upload/' . $files['datei']['name']);
            echo "<p id=\"green\">Upload hat geklappt</p>";
            $this->showNewBug();
        } else {
            $this->showHome();
        }
    }

}