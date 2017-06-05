<?php
namespace aptghetto\bugtracker\Service;

class BugServiceMySQL implements BugService {
	
	private $pdo;
	
	public function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}
	
	public function createNewBug($title, $description) {
		$stmt = $this->pdo->prepare("INSERT INTO bug ( title, description ) VALUES ( ?, ? )");
		$stmt->execute($title, $description);
		
		return $stmt->rowCount() == 1;
	}
}