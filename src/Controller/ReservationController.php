<?php

namespace App\Controller;

use App\Model\ReservationManager;

class ReservationController extends AbstractController
{
    public function index(): string
    {
        if (!$this->isUserLoggedIn()) {
            header('Location: /login');
            return '';
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = array_map('trim', $_POST);
            $requiredFields = ['lastname', 'firstname', 'chambre', 'demands', 'date_entry', 'date_exit'];

            foreach ($requiredFields as $field) {
                if (empty($reservation[$field])) {
                    $errors[$field] = 'Ce champ est obligatoire';
                }
            }

            if (empty($errors)) {
                $userId = $_SESSION['user_id'];
                $reservationManager = new ReservationManager();
                $reservationManager->insertResa($reservation, $userId);
                header('Location: /');
                exit(); // Ajout d'une sortie pour éviter l'exécution continue du code après la redirection.
            }
        }

        return $this->twig->render('Reservation/_reservation.html.twig', [
            'errors' => $errors,
        ]);
    }

    private function isUserLoggedIn(): bool
    {
        return isset($_SESSION['islogin']) && $_SESSION['islogin'] === true;
    }
}
