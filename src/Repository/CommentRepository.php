<?php

namespace App\Repository;

use App\Entity\Comment;

class CommentRepository {

    public function findAll() {
        $connection = Database::connect();
        $list = [];

        $preparedQuery = $connection->prepare("SELECT * FROM comment");
        $preparedQuery->execute();

        while ($row = $preparedQuery->fetch()) {
            $comment = new Comment(
                $row["content"],
                $row["date"],
                $row["likes"],
                $row["commentID"],
            );
            $list[]=$comment;
        }
        return $list;
    }
    public function findById(int $id): ?Comment {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM comment WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        $row = $preparedQuery->fetch();
        if ($row) {
            $comment = new Comment(
                $row["content"],
                $row["date"],
                $row["likes"],
                $row["publicationID"]
            );
            return $comment;
        }
        return NULL;
    }
    public function persist(Comment $comment) {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("INSERT INTO comment (title, content, date, likes) VALUES (:title, :content, :date, :likes)");

        $preparedQuery->bindValue(":content", $comment->getContent());
        $preparedQuery->bindValue(":date", $comment->getDate());
        $preparedQuery->bindValue(":likes", $comment->getLikes());
        $preparedQuery->bindValue(":publicationID", $comment->getpublicationID());

        $preparedQuery->execute();

        $comment->setId($connection->lastInsertId());
    }
    public function delete(int $id) {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("DELETE FROM comment WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }

    public function update(Comment $comment) {
        $connection = Database::connect();
        $preparedQuery= $connection->prepare("UPDATE comment SET title=:title, content=:content, date=:date, likes=:likes");

        $preparedQuery->bindValue(":content", $comment->getContent());
        $preparedQuery->bindValue(":date", $comment->getDate());
        $preparedQuery->bindValue(":likes", $comment->getLikes());
        $preparedQuery->bindValue(":publicationID", $comment->getPublicationID());

        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }
}