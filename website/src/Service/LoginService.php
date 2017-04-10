<?php 
namespace aptghetto\Service;

interface LoginService {
	public function authenticate($username, $password);
}