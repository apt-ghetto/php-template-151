<?php
namespace aptghetto\bugtracker\Service;

interface BugService {
	public function createNewBug($title, $description);
}