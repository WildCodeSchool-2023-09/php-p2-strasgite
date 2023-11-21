<?php

namespace App\Controller;

use App\Model\RoomManager;
use App\Model\ImageManager;
use App\Model\DashboardManager;
use App\Model\DashboardChambreManager;

class RoomController extends AbstractController
{
    public function show(int $id): string
    {
        $dashboardManager = new DashboardChambreManager();
        $imageManager = new ImageManager();

        return $this->twig->render('chambre/show.html.twig', [
            'chambre' => $dashboardManager->selectOneById($id),
            'images' => $imageManager->selectImageByRoom($id),
        ]);
    }

    public function index(): string
    {
        $roomManager = new RoomManager();
        $rooms = $roomManager->selectAll();

        return $this->twig->render('Home/_mainaccueil.html.twig', ['rooms' => $rooms]);
    }

    public function showAllRooms(): string
    {
        return $this->twig->render('chambre/home.html.twig');
    }
}
