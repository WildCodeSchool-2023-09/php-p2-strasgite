<?php

namespace App\Controller;

use App\Model\DashboardManager;
use App\Model\CategorieManager;

class DashboardTarifsController extends AbstractController
{
    public function index()
    {
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            $dashboardManager = new DashboardManager();
            return $this->twig->render('admin/Tarifs/index.html.twig', ['stuffs' => $dashboardManager->selectAllStuff()]);
        }
    }

    public function new()
    {
        {
            $categorieManager = new CategorieManager();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // clean $_POST data
                $chambre = array_map('trim', $_POST);
    
                // TODO validations (length, format...)
                
                // if validation is ok, insert and redirection
                $dashboardManager = new DashboardManager();
                $dashboardManager->insert($chambre);

                header('Location:/admin/Tarifs');
                return;
            }
    
            return $this->twig->render('Admin/Tarifs/form.html.twig',
            ['categories' => $categorieManager->selectAll()]);
        }
    }
}
