<?php

namespace App\Controller;

class RoomController extends AbstractController
{
    public function show(): string
    {
        return $this->twig->render('chambre/show.html.twig');
    }
}
