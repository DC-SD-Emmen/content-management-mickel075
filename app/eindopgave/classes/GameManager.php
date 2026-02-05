<?php

/**
 * GameManager: alle DB operaties voor games
 */
class GameManager {

    // Properties
    private $conn;
    
    // Constructor
    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Haal alle games op
     */
    public function getAllGames(): array {
        $stmt = $this->conn->query("SELECT * FROM games ORDER BY title ASC");
        $rows = $stmt->fetchAll();
        $games = [];
        foreach ($rows as $r) {
            $games[] = new Game($r['title'], $r['genre'], $r['platform'], $r['release_year'], $r['rating'], $r['beschrijving'], $r['image_name'], $r['id']);
        }
        return $games;
    }

    /**
     * Haal één game op op basis van id
     */
    public function getGameById(int $id): ?Game {
        $stmt = $this->conn->prepare("SELECT * FROM games WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $r = $stmt->fetch();
        if (!$r) return null;
        return new Game($r['title'], $r['genre'], $r['platform'], $r['release_year'], $r['rating'], $r['beschrijving'],  $r['image_name'], $r['id']);
    }

    /**
     * Voeg een nieuwe game toe
     */
public function addGame(Game $game): int {
        $stmt = $this->conn->prepare(
            "INSERT INTO games (title, genre, platform, release_year, rating, beschrijving, image_name)
             VALUES (:title, :genre, :platform, :release_year, :rating, :beschrijving, :image_name)"
        );
        $stmt->execute([
            'title' => $game->getTitle(),
            'genre' => $game->getGenre(),
            'platform' => $game->getPlatform(),
            'release_year' => $game->getReleaseYear(),
            'rating' => $game->getRating(),
            'beschrijving' => $game->getDescription(),
            'image_name' => $game->getImageName(),
        ]);
        return (int)$this->conn->lastInsertId();
    }

    /**
     * Update bestaande game
     */
    public function updateGame(Game $game): bool {
        if (!$game->getId()) throw new InvalidArgumentException("Game id ontbreekt voor update.");
        $stmt = $this->conn->prepare(
            "UPDATE games SET title = :title, genre = :genre, platform = :platform, release_year = :release_year, rating = :rating, beschrijving = :beschrijving, image_name = :image_name WHERE id = :id"
        );
        return $stmt->execute([
            'title' => $game->getTitle(),
            'genre' => $game->getGenre(),
            'platform' => $game->getPlatform(),
            'release_year' => $game->getReleaseYear(),
            'rating' => $game->getRating(),
            'beschrijving' => $game->getDescription(),
            'image_name' => $game->getImageName(),
            'id' => $game->getId(),
        ]);
    }

    /**
     * Verwijder game
     */
    public function deleteGame(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM games WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function file_upload($file) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($file["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            return false;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return true;
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }
    }

}

?>