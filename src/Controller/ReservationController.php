<?php

namespace App\Controller;

class ReservationController extends AbstractController
{
    public function index(): string
    {

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $reservation = array_map('trim', $_POST);
            if ($reservation['lastname'] === "") {
                $errors['lastname'] = "veuillez remplir votre nom";
            }
            if ($reservation['firstname'] === "") {
                $errors['firstname'] = "veuillez remplir votre Prénom";
            }
            if ($reservation['date_entry'] === "") {
                $errors['date_entry'] = "Veuillez sélectionner une date d'entrée.";
            } elseif (!strtotime($reservation['date_entry'])) {
                $errors['date_entry'] = "Format de date d'entrée invalide.";
            }
            if ($reservation['date_exit'] === "") {
                $errors['date_exit'] = "Veuillez sélectionner une date de sortie.";
            } elseif (!strtotime($reservation['date_exit'])) {
                $errors['date_exit'] = "Format de date de sortie invalide.";
            }
            if (!isset($reservation['chambre']) || $reservation['chambre'] === "") {
                $errors['chambre'] = "Veuillez choisir une chambre.";
            }
            if (strlen($reservation['demands']) > 255) {
                $errors['demands'] = "Les spécifités demandées sont trop longues (max 255 caractères).";
            }
            if (empty($errors)) {
                $reservationManager = new ReservationManager();
                $reservationManager->insert($reservation);
                header('Location: /');
            }
        }

        return $this->twig->render('reservation/_reservation.html.twig', [
            'errors' => $errors
        ]);
    }
}







    
