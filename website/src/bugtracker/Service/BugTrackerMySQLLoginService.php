<?php

namespace aptghetto\bugtracker\Service;

class BugTrackerMySQLLoginService implements BugTrackerLoginService {
	
	private $pdo;
	
	public function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}
	
	public function authenticate($username, $password) {
		$stmt = $this->pdo->prepare("SELECT email FROM nutzer WHERE email = ? AND passhash = ? AND token IS NULL");
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $this->hashPass($password));
		$stmt->execute();
	
		return $stmt->rowCount() == 1;
	}
	
	
	
	public function createNewUser($nutzername, $email, $password) {
		if ($this->userExistsNot($nutzername, $email)) {
			$stmt = $this->pdo->prepare("INSERT INTO nutzer (nutzername, email, passhash, token) VALUES (?, ?, ?, ?)");
			$stmt->bindValue(1, $nutzername);
			$stmt->bindValue(2, $email);
			$stmt->bindValue(3, $this->hashPass($password));
			$stmt->bindValue(4, $this->generateToken());
			$stmt->execute();
			
			return true;
		} else {
			return false;
		}
	}
	
	public function activateUser($id, $token) {
		$stmt = $this->pdo->prepare("UPDATE nutzer SET token = NULL WHERE id = ? AND token = ?");
		$stmt->bindValue(1, $id);
		$stmt->bindValue(2, $token);
		$stmt->execute();
	}
	
	public function getUserTokenAndId($nutzername, $email) {
		$stmt = $this->pdo->prepare("SELECT id, nutzername, email, token FROM nutzer WHERE nutzername = ? AND email = ?");
		$stmt->bindValue(1, $nutzername);
		$stmt->bindValue(2, $email);
		$stmt->execute();
		
		return $stmt->fetch();
	}
	
	private function hashPass($password) {
		return password_hash($password, PASSWORD_BCRYPT, array('cost', 13));
	}
	
	private function generateToken() {
		return bin2hex(random_bytes(32));
	}
	
	private function userExistsNot($nutzername, $email) {
		$stmt = $this->pdo->prepare("SELECT id FROM nutzer WHERE nutzername = ? OR email = ?");
		$stmt->bindValue(1, $nutzername);
		$stmt->bindValue(2, $email);
		
		$stmt->execute();
		
		return $stmt->rowCount() == 0;
	}
	
	/*
	 * $password = "my-secret-pw";
	 * $hash = password_hash($password, PASSWORD_DEFAULT);
	 * echo "Hash: " . $hash . "<br/>";
	 * echo "Is true?";			password_verify
	 *
	 */
}