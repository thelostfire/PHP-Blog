<?php

namespace App\Entity;

class Comment {

    private string $content;
    private string $date;
    private int $likes;
    private string $author;
    private int $publicationID;
    private int $id;

    public function __construct(string $content, string $date, int $likes, string $author, int $publicationID) {

        $this->content = $content;
        $this->date = $date;
        $this->likes = $likes;
        $this->author = $author;
        $this->publicationID = $publicationID;
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
    public function getpublicationID() {
        return $this->publicationID;
    }
    public function setPublicationID($publicationID) {
        $this->publicationID = $publicationID;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

}