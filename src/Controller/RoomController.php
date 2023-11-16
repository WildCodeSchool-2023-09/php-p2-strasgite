<?php

namespace App\Controller;

use App\Model\RoomManager;

class RoomController extends AbstractController
{
    public function show(): string
    {
        return $this->twig->render('chambre/show.html.twig');
    }

    public function index(): string
    {
        $roomManager = new RoomManager();
        $rooms = $roomManager->selectAll();

        return $this->twig->render('Home/_mainaccueil.html.twig', ['rooms' => $rooms]);
    }
}
