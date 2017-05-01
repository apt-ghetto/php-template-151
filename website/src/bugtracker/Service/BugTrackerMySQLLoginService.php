<?php

namespace aptghetto\bugtracker\Service;

class BugTrackerMySQLLoginService implements BugTrackerLoginService {
	
	private $pdo;
	
	public function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}
	
	public function authenticate($username, $password) {
		$stmt = $this->pdo->prepare("SELECT email FROM nutzer WHERE email = ? AND password = ?");
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $password);
		$stmt->execute();
	
		return $stmt->rowCount() == 1;
	}
}