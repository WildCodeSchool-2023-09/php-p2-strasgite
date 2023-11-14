<?php

namespace App\Model;

use PDO;

class DashboardManager extends AbstractManager
{

    public const TABLE = 'chambre';
    protected PDO $pdo;
    public function selectChambres(): array
    {
        $query = 'SELECT * FROM ' . self::TABLE;
        return $this->pdo->query($query)->fetchAll();
    }
}