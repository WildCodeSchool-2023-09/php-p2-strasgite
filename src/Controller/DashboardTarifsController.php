<?php

namespace App\Controller;

use App\Model\DashboardManager;

class DashboardTarifsController extends AbstractController
{
    public function index()
    {
        $dashboardManager = new DashboardManager();
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            return $this->twig->render('admin/Tarifs/index.html.twig', [
                'chambres' => $dashboardManager->selectAll()
            ]);
        }
    }
}
