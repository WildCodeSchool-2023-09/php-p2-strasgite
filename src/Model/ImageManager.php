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
}
