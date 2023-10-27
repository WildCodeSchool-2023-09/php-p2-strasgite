<?php

namespace App\Controller;

class CoworkingController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Coworking/index.html.twig');
    }
}