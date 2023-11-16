<?php

namespace App\Controller;

use App\Model\DashboardManager;

class DashboardController extends AbstractController
{
    public function index()
    {
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            return $this->twig->render('admin/dashboard/index.html.twig');
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

    public function deleteChambre(): void
    {
        $dashboardManager = new DashboardManager();
        $dashboardManager->delete($_GET['id']);
        header('Location:/admin/Tarifs');
    }
}
