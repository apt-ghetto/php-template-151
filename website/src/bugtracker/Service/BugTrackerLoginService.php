<?php
namespace aptghetto\bugtracker\Service;

interface BugTrackerLoginService {
    public function authenticate($username, $password);

    public function createNewUser($nutzername, $email, $password);

    public function activateUser($id, $token);

    public function getUserTokenAndId($nutzername, $email);

}