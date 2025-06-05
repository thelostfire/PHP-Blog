<?php

namespace App\Repository;

use App\Entity\Publication;

class PublicationRepository {

    public function findAll() {
        $connection = Database::connect();
        $list = [];

        $preparedQuery = $connection->prepare("SELECT * FROM publication");
        $preparedQuery->execute();

        while ($row = $preparedQuery->fetch()) {
            $publication = new Publication(
                $row["title"],
                $row["content"],
                $row["date"],
                $row["likes"],
                $row["author"],
                $row["imageURL"],
                $row["id"]
            );
            $list[]=$publication;
        }
        return $list;
    }
    public function findById(int $id): ?Publication {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM publication WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        $row = $preparedQuery->fetch();
        if ($row) {
            $publication = new Publication(
                $row["title"],
                $row["content"],
                $row["date"],
                $row["likes"],
                $row["author"],
                $row["imageURL"],
                $row["id"]
            );
            return $publication;
        }
        return NULL;
    }
    public function persist(Publication $publication) {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("INSERT INTO publication (title, content, date, likes, author, imageURL) VALUES (:title, :content, :date, :likes, :author, :imageURL)");

        $preparedQuery->bindValue(":title", $publication->getTitle());
        $preparedQuery->bindValue(":content", $publication->getContent());
        $preparedQuery->bindValue(":date", $publication->getDate());
        $preparedQuery->bindValue(":likes", $publication->getLikes());
        $preparedQuery->bindValue(":author", $publication->getAuthor());
        $preparedQuery->bindValue(":imageURL", $publication->getImageURL());

        $preparedQuery->execute();

        $publication->setId($connection->lastInsertId());
    }
    public function delete(int $id) {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("DELETE FROM publication WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }

    public function update(Publication $publication) {
        $connection = Database::connect();
        $preparedQuery= $connection->prepare("UPDATE publication SET title=:title, content=:content, date=:date, likes=:likes, imageURL=:imageURL WHERE id=:id");

        $preparedQuery->bindValue(":title", $publication->getTitle());
        $preparedQuery->bindValue(":content", $publication->getContent());
        $preparedQuery->bindValue(":date", $publication->getDate());
        $preparedQuery->bindValue(":likes", $publication->getLikes());
        $preparedQuery->bindValue(":id", $publication->getId());
        $preparedQuery->bindValue(":imageURL", $publication->getImageURL());

        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }
}