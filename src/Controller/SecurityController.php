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
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['profession'] = $user['profession'];
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
        unset($_SESSION['email']);
        unset($_SESSION['profession']);
        if (isset($_SESSION['isadmin'])) {
            unset($_SESSION['isadmin']);
        }
        header('Location:/');
    }

    public function verify()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['email'] != '' && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Veuillez renseigner un email valide';
            }
            $userManager = new UserManager();
            if ($userManager->emailExist($_POST['email'])) {
                $errors['compte'] = 'Un compte existe deja avec cet email';
            }
            $requireds = ["firstname", "lastname", "email", "password", "adresse", "tel"];
            foreach ($requireds as $required) {
                if ($_POST[$required] == '') {
                    $errors[$required] = 'Ce champ est obligatoire';
                }
            }
            return $errors;
        }
    }

    public function signin()
    {
        $errors = $this->verify();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_SESSION['islogin']) && $_SESSION['islogin'] === true) {
                header('Location:/');
                return;
            }

            if (!$errors) {
                $userManager = new UserManager();
                $user = $userManager->userSignin($_POST);
                if ($user) {
                    $_SESSION['islogin'] = true;
                    $_SESSION['isadmin'] = $user['isadmin'];
                    $_SESSION['email'] = $user['email'];
                }
                header('Location:/login');
            }
        }
        return $this->twig->render('Security/_signin.html.twig', ['errors' => $errors]);
    }
}
