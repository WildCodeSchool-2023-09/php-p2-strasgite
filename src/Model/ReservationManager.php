<?php

namespace App\Model;

use PDO;

class ReservationManager extends AbstractManager
{
    public const TABLE = 'reservation';
    public function insert(array $reservation): int
    {
        $userId = isset($_SESSION['email']) ? $_SESSION['email'] : null;
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (chambre_id,id_user, firstname, lastname, date_entry, date_exit, demand) 
            VALUES (:chambre_id, :id_user, :firstname, :lastname, :date_entry, :date_exit, :demands)");
        $statement->bindValue(':chambre_id', $reservation['chambre']);
        $statement->bindValue(':id_user', $userId, PDO::PARAM_STR);
        $statement->bindValue(':firstname', $reservation['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':lastname', $reservation['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':date_entry', $reservation['date_entry']);
        $statement->bindValue(':date_exit', $reservation['date_exit']);
        $statement->bindValue(':demands', $reservation['demands'], PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
