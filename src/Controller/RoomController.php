<?php

namespace App\Controller;

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
}
