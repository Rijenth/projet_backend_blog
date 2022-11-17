<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\PostManager;
use App\Route\Route;

class PostController extends AbstractController
{

    #[Route('/', name: 'home', methods: ['GET'])]
    public function home()
    {
        $view = dirname(__DIR__, 2) . '/layout/blog/blog.layout.php';
        $this->render(
            $view,
            [
                "pageTitle" => "Home",
            ],
        );
    }
}