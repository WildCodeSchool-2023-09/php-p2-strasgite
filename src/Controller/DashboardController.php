<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ContactManager;

class DashboardController extends AbstractController
{
    public function index()
    {
        
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            $contactManager = new contactManager;
            $messages = $contactManager->selectAll('', '');

            $id = mysql_real_escape_string( $_GET["id"] );
            mysql_query("DELETE FROM usager WHERE id ='".$id."'");

            return $this->twig->render('admin/dashboard/index.html.twig', ['messages'=> $messages]);
        }

        
    }

    
}
