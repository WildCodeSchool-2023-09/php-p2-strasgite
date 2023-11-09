<?php

namespace App\Controller;

class DashboardController extends AbstractController
{
    public function index()
    {
        if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] === true) {
            return $this->twig->render('admin/dashboard/index.html.twig');
        } else {
            header('Location:/');
        }
    }
}