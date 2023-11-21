<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class ImageManager extends AbstractManager
{
    public const TABLE = 'image';

    protected PDO $pdo;

    public function selectImageByRoom(int $idChambreImg)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE  id_chambre_img = :id_chambre_img");
        $statement->bindValue('id_chambre_img', $idChambreImg, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function insertImage(int $idChambreImg, string $image, string $name)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . static::TABLE . " (id_chambre_img, img, name ) 
        VALUES ( :id_chambre_img, :img, :name)");
        $statement->bindValue(':id_chambre_img', $idChambreImg, PDO::PARAM_INT);
        $statement->bindValue(':img', $image, PDO::PARAM_STR);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function updateImage(string $image, int $idChambreImg)
    {
        $statement = $this->pdo->prepare(
            "UPDATE " . static::TABLE . " SET img = :img WHERE id_chambre_img = :id_chambre_img"
        );
        $statement->bindValue(':id_chambre_img', $idChambreImg, PDO::PARAM_INT);
        $statement->bindValue(':img', $image, PDO::PARAM_STR);
        $statement->execute();
    }
}
