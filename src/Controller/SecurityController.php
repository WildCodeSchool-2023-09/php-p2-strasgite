<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\UserManager;

class SecurityController extends AbstractController
{
    public function login()
    {

        $errors = [];
        if (isset($_SESSION['islogin']) && $_SESSION['islogin'] === true) {
            header('Location:/');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['email'] == '') {
                $errors['email'] = 'Veuillez renseigner votre email';
            }

            if ($_POST['password'] == '') {
                $errors['password'] = 'Veuillez renseigner votre password';
            }

            if (!$errors) {
                $userManager = new UserManager();
                $user = $userManager->userLogin($_POST);
                if ($user) {
                    $_SESSION['islogin'] = true;
                    $_SESSION['isadmin'] = $user['isadmin'];

                    header('Location:/');
                } else {
                    $errors['login'] = 'Email ou mot de passe incorrect';
                }
            }
        }
        return $this->twig->render('Security/_login.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        unset($_SESSION['islogin']);
        if (isset($_SESSION['isadmin'])) {
            unset($_SESSION['isadmin']);
        }
        header('Location:/');
    }
}
