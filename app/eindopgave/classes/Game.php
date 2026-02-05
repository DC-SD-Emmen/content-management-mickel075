<?php

    class Game {

        // Properties
        private $id;
        private $title;
        private $genre;
        private $platform;
        private $release_year;
        private $rating;
        private $description;
        private $image_name;

        // Constructor
        public function __construct($title = '', $genre = '', $platform = '', $release_year = null, $rating = null, $description = '', $image_name = '', $id = null) {
            $this->title = $title;
            $this->genre = $genre;
            $this->platform = $platform;
            $this->release_year = $release_year === '' ? null : $release_year;
            $this->rating = $rating === '' ? null : $rating;
            $this->description = $description;
            $this->id = $id;
            $this->image_name = $image_name;
        }

        // Getters
        public function getId() { return $this->id; }
        public function getTitle() { return $this->title; }
        public function getGenre() { return $this->genre; }
        public function getPlatform() { return $this->platform; }
        public function getReleaseYear() { return $this->release_year; }
        public function getRating() { return $this->rating; }
        public function getDescription() { return $this->description; }
        public function getImageName() { return $this->image_name; }

        // Setters
        public function setId($id) { $this->id = $id; }
        public function setTitle($title) { $this->title = $title; }
        public function setGenre($genre) { $this->genre = $genre; }
        public function setPlatform($platform) { $this->platform = $platform; }
        public function setReleaseYear($year) { $this->release_year = $year; }
        public function setRating($rating) { $this->rating = $rating; }
        public function setDescription($description) { $this->description = $description; }
        public function setImageName($image_name) { $this->image_name = $image_name; }

    }

?>