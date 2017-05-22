<?php

namespace aptghetto\bugtracker\Service;

class BugTrackerMySQLLoginService implements BugTrackerLoginService {
	
	private $pdo;
	
	public function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}
	
	public function authenticate($username, $password) {
		$stmt = $this->pdo->prepare("SELECT email FROM nutzer WHERE email = ? AND password = ? AND token IS NULL");
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $this->hashPass($password));
		$stmt->execute();
	
		return $stmt->rowCount() == 1;
	}
	
	private function hashPass($password) {
		return password_hash($password, PASSWORD_BCRYPT, array('cost', 13));
	}
	
	private function generateToken() {
		return bin2hex(random_bytes(32));
	}
	
	public function createNewUser($username, $password) {
		$stmt = $this->pdo->prepare("INSERT INTO nutzer (email, passhash, token) VALUES (?, ?, ?)");
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $this->hashPass($password));
		$stmt->bindValue(3, $this->generateToken());
		
		$stmt->execute();
		
		
	}
	/*
	 * $password = "my-secret-pw";
	 * $hash = password_hash($password, PASSWORD_DEFAULT);
	 * echo "Hash: " . $hash . "<br/>";
	 * echo "Is true?";			password_verify
	 *
	 */
}