<?php

namespace App\Controller;

use App\Route\Route;
use App\Factory\PDOFactory;
use App\Manager\UserManager;


class SecurityController extends AbstractController
{
    #[Route('/login', name:'login', methods: ['GET'])]
    public function login()
    {
        $manger = new UserManager(new PDOFactory());
        $this->render("login.php", ["posts" => $user], "Tous les posts");
    }

    #[Route('/register', name :'register', methods: ['GET'])]
    public function register()
    {
        $manger = new UserManager(new PDOFactory());
        $this->render("home.php", ["posts" => $posts], "Tous les posts");


    }
}