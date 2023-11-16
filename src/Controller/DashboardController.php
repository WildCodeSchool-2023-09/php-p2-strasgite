<?php

namespace App\Controller;

use App\Model\DashboardManager;

class DashboardController extends AbstractController
{
    public function index()
    {
        $dashboardManager = new DashboardManager();
        $reservations = $dashboardManager->getAllReservations();
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
            $dashboardManager = new DashboardManager();
            $dashboardManager->deleteReservation($id);
            header('Location:/admin/dashboard');
        }
    }
}
