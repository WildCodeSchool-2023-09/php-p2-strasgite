<?php

namespace App\Controller;

use App\Model\DashboardManager;
use App\Model\ImageManager;

class RoomController extends AbstractController
{
    public function show(int $id): string
    {
        $dashboardManager = new DashboardManager();
        $imageManager = new ImageManager();

        return $this->twig->render('chambre/show.html.twig', [
            'chambre' => $dashboardManager->selectOneById($id),
            'images' => $imageManager->selectImageByRoom($id),
            'chambres' => $dashboardManager->selectAll()
        ]);
    }
}
