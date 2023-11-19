<?php

namespace App\Controller;

use App\Model\TarifsManager;

class TarifsController extends AbstractController
{
    public function index(): string
    {
        $tarifsManager = new TarifsManager();
        $chambres = $tarifsManager->selectPrix();
        return $this->twig->render('tarifs/_tarifs.html.twig', ['chambres' => $chambres]);
    }
}
