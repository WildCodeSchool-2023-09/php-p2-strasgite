<?php

namespace App\Controller;

use App\Model\ReservationManager;

class ReservationController extends AbstractController
{
    public function index(): string
    {
        $errors = [];
        
        if (!isset($_SESSION['islogin']) || $_SESSION['islogin'] !== true) {
            header('Location: /login');
            return '';
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $reservation = array_map('trim', $_POST);
            $allErrors = ["lastname","firstname","chambre","demands","date_entry","date_exit"];
            foreach ($allErrors as $error) {
                if ($reservation[$error] == "") {
                    $errors[$error] = "Ce champ est obligatoire";
                }
            }
            if (empty($errors)) {
                $reservationManager = new ReservationManager();
                $reservationManager->insertResa($reservation);
                header('Location: /reservation');
            }
        }
        return $this->twig->render('reservation/_reservation.html.twig', [
            'errors' => $errors,
        ]);
    }
}
