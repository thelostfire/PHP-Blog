<?php

namespace App\Entity;

class Publication {

    private string $title;
    private string $content;
    private string $date;
    private int $likes;
    private string $author;
    private ?string $imageURL;
    private ?int $id;

    public function __construct(string $title, string $content, string $date, int $likes, string $author, ?string $imageURL = null, ?int $id = null) {

        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->likes = $likes;
        $this->author = $author;
        $this->imageURL = $imageURL;
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function getContent() {
        return $this->content;
    }
    public function setContent($content) {
        $this->content = $content;
    }
    public function getDate() {
        return $this->date;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    public function getLikes() {
        return $this->likes;
    }
    public function setLikes($likes) {
        $this->likes = $likes;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }
    public function getImageURL() {
        return $this->imageURL;
    }
    public function setImageURL($imageURL) {
        $this->imageURL = $imageURL;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
}