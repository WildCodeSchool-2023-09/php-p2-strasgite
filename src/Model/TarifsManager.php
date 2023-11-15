<?php

namespace App\Model;

class TarifsManager extends AbstractManager
{
    public const TABLE = 'chambre';
    public const PARLEMENTAIRE = 'Parlementaire';

    public function selectPrix(): array
    {
        if (isset($_SESSION['profession']) && $_SESSION['profession'] === self::PARLEMENTAIRE) {
            $query = 'SELECT name, prix - (prix * 0.10) AS prix FROM ' . self::TABLE;
            return $this->pdo->query($query)->fetchAll();
        } else {
            $query = 'SELECT name, prix FROM ' . self::TABLE;
            return $this->pdo->query($query)->fetchAll();
        }
    }
}
