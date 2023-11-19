<?php

namespace App\Model;

use PDO;

class ReservationManager extends AbstractManager
{
    public const TABLE = 'reservation';
    public function insertResa(array $reservation): int
    {
        $email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

        $getIdUser = "SELECT id_user FROM user WHERE email = :email";
        $getIdUserStatement = $this->pdo->prepare($getIdUser);
        $getIdUserStatement->bindParam(':email', $email, PDO::PARAM_STR);
        $getIdUserStatement->execute();
        $user = $getIdUserStatement->fetch(PDO::FETCH_ASSOC);
        $userId = $user['id_user'];
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (chambre_id,id_user, firstname, lastname, date_entry, date_exit, demand) 
            VALUES (:chambre_id, :id_user, :firstname, :lastname, :date_entry, :date_exit, :demands)");
        $statement->bindValue(':chambre_id', $reservation['chambre']);
        $statement->bindValue(':id_user', $userId, PDO::PARAM_INT);
        $statement->bindValue(':firstname', $reservation['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':lastname', $reservation['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':date_entry', $reservation['date_entry']);
        $statement->bindValue(':date_exit', $reservation['date_exit']);
        $statement->bindValue(':demands', $reservation['demands'], PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function deleteResa(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id_reservation = :id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        return $statement->execute();
    }

    public function selectAllResa(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = "SELECT r.id_reservation, c.id_chambre, c.name AS name , r.date_entry, r.date_exit, 
        r.firstname, r.lastname, u.email, r.demand
        FROM " . self::TABLE . " r
        JOIN user AS u ON r.id_user = u.id_user
        JOIN chambre AS c ON c.id_chambre = r.chambre_id";
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
