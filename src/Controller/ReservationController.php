<?php

namespace App\Controller;

class ReservationController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Reservation/_reservation.html.twig');
    }
}