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
        $user = $manger->getAllUsers();
        $this->render("auth/auth.layout.php", ["posts" => $user], "Tous les posts");
        $view = dirname(__DIR__, 2) . '/components/form/login/login.component.php';
        require_once $view;

    }

    #[Route('/register', name :'register', methods: ['GET'])]
    public function register()
    {
        $manger = new UserManager(new PDOFactory());
        $user = $manger->getAllUsers();
        $this->render("auth/auth.layout.php", ["posts" => $user], "Tous les posts");
        $view = dirname(__DIR__, 2) . '/components/form/register/register.component.php';
        require_once $view;


    }
}