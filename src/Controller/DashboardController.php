<?php

namespace App\Controller;

use App\Model\UserManager;

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
}
