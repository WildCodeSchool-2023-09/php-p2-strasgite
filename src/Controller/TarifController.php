<?php

namespace App\Controller;

class TarifController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('tarifs/_tarifs.html.twig');
    }
}
