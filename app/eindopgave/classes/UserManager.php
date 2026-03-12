<?php

    class UserManager {

        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }


        //function for adding a user to the database
        //use $this->conn 
        //use PDO method
        //use prepared statement to prevent SQL injection
        //user try and catch for error handling
        public function addUser($userName, $userEmail, $userPassword) {
            try {
                $stmt = $this->conn->prepare("INSERT INTO users (userName, userEmail, userPassword) VALUES (:username, :email, :password)");
                $stmt->execute([
                    ':username' => $userName,
                    ':email' => $userEmail,
                    ':password' => password_hash($userPassword, PASSWORD_DEFAULT)
                ]);
                return true;
            } catch (PDOException $e) {
                // Handle error (e.g., log it)
                return false;
            }
        }

        //with the same methods also add a function for deleting a user from the database
        public function deleteUser($userID) {
            try {
                $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
                $stmt->execute([
                    ':id' => $userID
                ]);
                return true;
            } catch (PDOException $e) {
                // Handle error (e.g., log it)
                return false;
            }
        }

        //function for getting all users from the database
        public function getAllUsers() {
            try {
                $stmt = $this->conn->query("SELECT * FROM users");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Handle error (e.g., log it)
                return [];
            }
        }

        //function for getting a user by id from the database
        public function getUserById($userID) {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
                $stmt->execute([
                    ':id' => $userID
                ]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Handle error (e.g., log it)
                return false;
            }
        }

        //function for updating a user in the database
        public function updateUser($userID, $userName, $userEmail) {
            try {
                $stmt = $this->conn->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
                $stmt->execute([
                    ':username' => $userName,
                    ':email' => $userEmail,
                    ':id' => $userID
                ]);
                return true;
            } catch (PDOException $e) {
                // Handle error (e.g., log it)
                return false;
            }
        }


        //addToWishlist function that adds a game to the user's wishlist
        public function addToWishlist($userID, $gameID) {
            try {
            $stmt = $this->conn->prepare("INSERT INTO wishlist (userID, gameID) VALUES (:userID, :gameID)");
            $stmt->execute([
                ':userID' => $userID,
                ':gameID' => $gameID
            ]);
            return true;
            } catch (PDOException $e) {
            // Handle error (e.g., log it)
            return false;
            }
        }

        //getWishlist function that gets all games from the user's wishlist
        public function getWishlist($user_id): array {
            $stmt = $this->conn->prepare("SELECT g.* FROM games g JOIN wishlist w ON g.id = w.gameID WHERE w.userID = :user_id");
            $stmt->execute(['user_id' => $user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>