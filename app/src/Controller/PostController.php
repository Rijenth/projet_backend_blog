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
        $manger = new PostManager(new PDOFactory());
        $posts = $manger->getAllPosts();
        $view = dirname(__DIR__, 2) . '/components/form/reg';
        require_once $view;
        $this->render("home.php", ["posts" => $posts], "Tous les posts");
    }
}