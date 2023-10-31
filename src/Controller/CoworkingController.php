<?php

namespace App\Controller;

class CoworkingController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Coworking/index.html.twig');
    }
}
