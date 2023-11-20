<?php

namespace App\Controller;

use App\Model\ContactManager;

class DashboardContactController extends AbstractController
{
    public function index()
    {
        if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] === 0 || !isset($_SESSION['islogin'])) {
            header('Location:/');
        } else {
            $contactManager = new ContactManager();
            $messages = $contactManager->selectAll('', '');

                return $this->twig->render('Admin/Contact/index.html.twig', ['messages' => $messages]);
        }
    }

    public function deleteMesssage(): void
    {
        $contactManager = new ContactManager();
        $contactManager->delete($_GET['id']);
        header('Location:/admin/Contact');
    }
}
