<?php

namespace App\Model;

use App\Model\AbstractManager;
use App\Model\ReservationManager;

class DashboardManager extends AbstractManager
{
    public const TABLE = 'reservation';

    public function getAllReservations(string $orderBy = '', string $direction = 'ASC'): array
    {
        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->selectAllResa($orderBy, $direction);
        return $reservations;
    }
    public function deleteReservation($id)
    {
        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->deleteResa($id);
        return $reservations;
    }
}
