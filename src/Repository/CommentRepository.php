<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Publication;

class CommentRepository {

    public function findAll() {
        $connection = Database::connect();
        $list = [];

        $preparedQuery = $connection->prepare("SELECT *,
                                        publication.id AS publication_id,  
                                        publication.content AS publication_content,
                                        publication.date AS publication_date,
                                        publication.author AS publcication_author,
                                        publication.likes AS publication_likes,
                                        publication.id AS publication_id,  
                                        comment.content AS comment_content,
                                        comment.date AS comment_date,
                                        comment.author AS publcication_author,
                                        comment.likes AS comment_likes,
                                        comment.id AS comment_id
                                        FROM comment LEFT JOIN publication ON publication.id = comment.publicationID");
        $preparedQuery->execute();

        while ($row = $preparedQuery->fetch()) {
            $publication = new Publication(
                $row["title"],
                $row["publication_content"],
                $row["publication_date"],
                $row["publication_likes"],
                $row["publication_author"],
                $row["imageURL"],
                $row["publication_id"]
            );
            $comment = new Comment(
                $row["comment_content"],
                $row["comment_date"],
                $row["comment_likes"],
                $row["comment_author"],
                $publication,
                $row["comment_id"]
            );
            $list[]=$comment;
        }
        return $list;
    }
    /**
     * Méthode qui s'occupe de récupérer tous les commentaires d'une même publication, en les triant
     * par date afin de les ordonner du plus récent au plus vieux (pour ensuite les afficher en-dessous de la publication).
     * @param int $id ID de la publication dont on cherche les commentaires
     * @return Comment[] liste triée des commentaires recherchés 
     */
    public function findAllByPublication(Publication $publication) {
        $connection = Database::connect();
        $list = [];

        $preparedQuery = $connection->prepare("SELECT * FROM comment WHERE publicationID = :publicationID ORDER BY date DESC");
        $preparedQuery->bindValue(":publicationID", $publication->getId());
        $preparedQuery->execute();

        while($row = $preparedQuery->fetch()) {
            $comment = new Comment(
                $row["content"],
                $row["date"],
                $row["likes"],
                $row["author"],
                $publication,
                $row["id"]
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
        $repo = new PublicationRepository;
        if ($row) {
            $comment = new Comment(
                $row["content"],
                $row["date"],
                $row["likes"],
                $row["author"],
                $repo->findById($row["publicationID"])
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
        $preparedQuery->bindValue(":publicationID", $comment->getpublication()->getId());

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
        $preparedQuery->bindValue(":publicationID", $comment->getPublication());

        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }
}