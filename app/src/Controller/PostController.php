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
    // Create a route for specific user
    #[Route('/user/{id}', name: 'user', methods: ['GET'])]
    public function user(string $id)
    {
        $view = dirname(__DIR__, 2) . '/layout/user/user.layout.php';
        $this->render(
            $view,
            [
                "pageTitle" => "User",
                "userId" => $id,
            ],
        );
    }
}