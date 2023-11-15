<?php

namespace App\Controller;

use App\Model\DashboardManager;

class DashboardController extends AbstractController
{
    public function index()
    {
        $dashboardManager = new DashboardManager();
        $reservations = $dashboardManager->getAllReservations();
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            return $this->twig->render('admin/dashboard/index.html.twig', ['reservations' => $reservations]);
        }
    }

    public function editChambre()
    {
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            $dashboardManager = new DashboardManager();
            $chambres = $dashboardManager->selectAll();
            return $this->twig->render('admin/dashboard/chambre.html.twig', ['chambres' => $chambres]);
        }
    }
}
