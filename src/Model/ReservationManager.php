<?php

namespace App\Model;

use PDO;

class ReservationManager extends AbstractManager
{
    public const TABLE = 'reservation';

    public function insertResa(array $reservation, int $userId): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (chambre_id, id_user, firstname, lastname, date_entry, date_exit, demand) 
            VALUES (:chambre_id, :id_user, :firstname, :lastname, :date_entry, :date_exit, :demands)");

        $statement->bindParam(':chambre_id', $reservation['chambre'], PDO::PARAM_INT);
        $statement->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $statement->bindParam(':firstname', $reservation['firstname'], PDO::PARAM_STR);
        $statement->bindParam(':lastname', $reservation['lastname'], PDO::PARAM_STR);
        $statement->bindParam(':date_entry', $reservation['date_entry']);
        $statement->bindParam(':date_exit', $reservation['date_exit']);
        $statement->bindParam(':demands', $reservation['demands'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function deleteResa(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id_reservation = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function selectAllResa(string $orderBy = 'id_reservation', string $direction = 'ASC'): array
    {
        // Vérifiez si la colonne de tri est une colonne valide pour éviter les attaques SQL.
        $validColumns = ['id_reservation', 'name', 'date_entry', 'date_exit',
        'firstname', 'lastname', 'email', 'demand'];
        $orderBy = in_array($orderBy, $validColumns) ? $orderBy : 'id_reservation';

        // Assurez-vous que la direction est valide (ASC ou DESC).
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

        $query = "SELECT reservation.id_reservation, chambre.id, chambre.name AS name, reservation.date_entry,
            reservation.date_exit, reservation.firstname, reservation.lastname, user.email, reservation.demand
            FROM " . self::TABLE . "
            JOIN user AS user ON reservation.id_user = user.id_user
            JOIN chambre AS chambre ON chambre.id = reservation.chambre_id
            ORDER BY $orderBy $direction";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
