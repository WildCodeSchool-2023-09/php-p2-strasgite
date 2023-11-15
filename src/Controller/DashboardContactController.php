<?php

namespace App\Controller;

class DashboardContactController extends AbstractController
{
    public function index()
    {
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            return $this->twig->render('admin/Contact/index.html.twig');
        }
    }
}
