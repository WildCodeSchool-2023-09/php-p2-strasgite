<?php

namespace App\Controller;

use Twig\Environment;
use App\Model\ImageManager;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
use App\Model\DashboardChambreManager;

abstract class AbstractController
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('chambres', $this->showRoom());
    }

    private function showRoom()
    {
        $dashboardCManager = new DashboardChambreManager();
        $rooms = $dashboardCManager->selectAllStuff();
        return $rooms;
    }
}
