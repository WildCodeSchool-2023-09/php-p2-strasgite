<?php

namespace App\Controller;

use App\Model\ContactManager;

class DashboardController extends AbstractController
{
    public function index()
    {
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            $contactManager = new ContactManager();
            $messages = $contactManager->selectAll('', '');

                return $this->twig->render('admin/dashboard/index.html.twig', ['messages' => $messages]);
        }
    }
}
