<?php

namespace App\Controller;

use App\Model\ReservationManager;
use App\Model\UserManager;

class DashboardController extends AbstractController
{
    public function index()
    {
        $dashboardController = new DashboardController();
        $reservations =  $dashboardController->getAllReservations();
        $informationsResa =
            [
            'nom',
            'prénom',
            'Email',
            'chambre',
            'date d\'arrivée',
            'date de sortie',
            'Demandes spécifiques',
            'actions'
        ];
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            return $this->twig->render('admin/dashboard/index.html.twig', [
                'reservations' => $reservations,
                'informationsResa' => $informationsResa
            ]);
        }
    }
    public function deleteReservation($id)
    {
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            $reservationManager = new ReservationManager();
            $reservationManager->deleteResa($id);
            header('Location:/admin/dashboard');
        }
    }
    public function getAllReservations(string $orderBy = '', string $direction = 'ASC'): array
    {
        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->selectAllResa($orderBy, $direction);
        return $reservations;
    }
}
