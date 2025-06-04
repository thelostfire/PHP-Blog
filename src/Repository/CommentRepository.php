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
                $row["author"],
                $row["publicationID"]
            );
            $list[]=$comment;
        }
        return $list;
    }
    /**
     * Méthode qui s'occupe de récupérer tous les commentaires d'une même publication par le biais de leur ID, en les triant
     * par date afin de les ordonner du plus récent au plus vieux (pour ensuite les afficher en-dessous de la publication).
     * @param int $id ID de la publication dont on cherche les commentaires
     * @return Comment[] liste triée des commentaires recherchés 
     */
    public function findAllByPublicationId(int $id) {
        $connection = Database::connect();
        $list = [];

        $preparedQuery = $connection->prepare("SELECT * FROM comment WHERE publicationID = :id ORDER BY date DESC");
        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        while($row = $preparedQuery->fetch()) {
            $comment = new Comment(
                $row["content"],
                $row["date"],
                $row["likes"],
                $row["author"],
                $row["publicationID"]
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
                $row["author"],
                $row["publicationID"]
            );
            return $comment;
        }
        return NULL;
    }
    public function persist(Comment $comment) {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("INSERT INTO comment (content, date, likes, author, publicationID) VALUES (:content, :date, :likes, :author, :publicationID)");

        $preparedQuery->bindValue(":content", $comment->getContent());
        $preparedQuery->bindValue(":date", $comment->getDate());
        $preparedQuery->bindValue(":likes", $comment->getLikes());
        $preparedQuery->bindValue(":author", $comment->getAuthor());
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
        $preparedQuery= $connection->prepare("UPDATE comment SET content=:content, date=:date, likes=:likes, author=:author, publicationID=:publicationID");

        $preparedQuery->bindValue(":content", $comment->getContent());
        $preparedQuery->bindValue(":date", $comment->getDate());
        $preparedQuery->bindValue(":likes", $comment->getLikes());
        $preparedQuery->bindValue(":author", $comment->getAuthor());
        $preparedQuery->bindValue(":publicationID", $comment->getPublicationID());

        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }
}