<?php

namespace App\Model;

class TarifsManager extends AbstractManager
{
    public const TABLE = 'chambre';
    public const PARLEMENTAIRE = 'parlementaire';

    public function selectPrix(): array
    {
        if (isset($_POST['profession']) && $_POST['profession'] === self::PARLEMENTAIRE) {
            $query = 'SELECT name, prix - (prix * 0.10) AS prixReduit FROM ' . self::TABLE;
            return $this->pdo->query($query)->fetchAll();
        } else {
            $query = 'SELECT name, prix FROM ' . self::TABLE;
            return $this->pdo->query($query)->fetchAll();
        }
    }
}
