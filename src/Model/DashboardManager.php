<?php

namespace App\Model;

use PDO;

class DashboardManager extends AbstractManager
{
    public const TABLE = 'chambre';
    public const IMAGE = 'image';
    public const CATEGORIES = 'categories';
    public const OPTIONS = 'options';

    public function selectAllStuff()
    {
        $query = ("SELECT chambre.*, MAX(image.img) AS img, categories.*, options.name AS option_name FROM  "
            . static::TABLE . " LEFT JOIN " . static::IMAGE . " ON chambre.id = image.id_chambre_img LEFT JOIN " .
            static::CATEGORIES . " ON chambre.id_categorie = categories.id_categories LEFT JOIN " . static::OPTIONS .
            " ON chambre.id_option = options.id_options GROUP BY chambre.id");
        
            return $this->pdo->query($query)->fetchAll();
    }

    public function insert(array $chambre)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . static::TABLE . " (name, id_option
        , id_categorie, prix, description) 
        VALUES ( :name, :id_option, :id_categorie, :prix, :description )");

        $statement->bindValue(':name', $chambre['name'], PDO::PARAM_STR);
        $statement->bindValue(':id_option', $chambre['id_option'], PDO::PARAM_INT);
        $statement->bindValue(':id_categorie', $chambre['id_categorie'], PDO::PARAM_INT);
        $statement->bindValue(':prix', $chambre['prix'], PDO::PARAM_STR);
        $statement->bindValue(':description', $chambre['description'], PDO::PARAM_STR);

        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
