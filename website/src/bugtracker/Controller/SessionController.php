<?php
namespace aptghetto\bugtracker\Controller;

class SessionController {

    public function createSessionToken() {
        $token = bin2hex(random_bytes(100));
        $_SESSION["token"] = $token;

        return $token;
    }

    public function hasValidToken($token) {
        return $token == $_SESSION["token"];
    }
}