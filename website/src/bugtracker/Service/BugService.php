<?php
namespace aptghetto\bugtracker\Service;

interface BugService {
    public function createNewBug($title, $description);

    public function getAllBugs();

    public function getBugById($id);

    public function saveBug(array $bug);

}