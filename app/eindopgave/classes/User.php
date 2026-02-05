<?php

class User {
    private $userID;
    private $userName;
    private $userEmail;

    public function __construct($userID, $userName, $userEmail) {
        $this->userID = $userID;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function getUserEmail() {
        return $this->userEmail;
    }

    public function setUserEmail($userEmail) {
        $this->userEmail = $userEmail;
    }
}