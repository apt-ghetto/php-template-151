<?php
namespace aptghetto\bugtracker\Service;

class BugServiceMySQL implements BugService {
	
	private $pdo;
	
	public function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}
	
	public function createNewBug($title, $description) {
		$stmt = $this->pdo->prepare("INSERT INTO bug ( title, description ) VALUES ( ?, ? )");
		$stmt->bindValue(1, $title);
		$stmt->bindValue(2, $description);
		$stmt->execute();
		
		return $stmt->rowCount() == 1;
	}
	
	public function editBug(array $bug) {
		
	}
	
	public function getAllBugs() {
		$stmt = $this->pdo->prepare("SELECT id, title, description, importance, status FROM bug ORDER BY importance DESC");
		$stmt->execute();
		
		return $stmt->fetchAll();
	}
	
	public function getBugById($id) {
		$stmt = $this->pdo->prepare("SELECT id, title, description, importance, status FROM bug WHERE id = ?");
		$stmt->bindValue(1, $id);
		$stmt->execute();
		
		return $stmt->fetch();
	}
}