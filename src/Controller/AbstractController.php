<?php

namespace App\Controller;

use Twig\Environment;
use App\Model\UserManager;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;

/**
 * Initialized some Controller common features (Twig...)
 */
abstract class AbstractController
{
    protected Environment $twig;

    //protected array $user;


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
        //$userManager = new UserManager;
        //$this->user = isset($_SESSION['isLogin'])?$userManager->userLogin($_SESSION['isLogin']):false;
    }
}
