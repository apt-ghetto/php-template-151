<?php
namespace aptghetto\bugtracker\Service;

interface BugService {
	public function createNewBug($title, $description);
	
	public function editBug(array $bug);
	
	public function getAllBugs();
	
	public function getBugById($id);
}