<?php
namespace aptghetto\bugtracker\Service;

interface BugTrackerLoginService {
	public function authenticate($username, $password);
	
	public function createNewUser($username, $password);
}