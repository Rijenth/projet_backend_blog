<?php

namespace App\Controller;

use App\Route\Route;
use App\Factory\PDOFactory;
use App\Manager\UserManager;


class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['GET'])]
    public function login()
    {
        $view = dirname(__DIR__, 2) . '/layout/auth/auth.layout.php';
        $this->render(
            $view,
            [
                "authForm" => dirname(__DIR__, 2) . "/components/form/login/login.component.php",
                "pageTitle" => "Login",
            ],
        );
    }

    #[Route('/register', name: 'registerView', methods: ['GET'])]
    public function registerView()
    {

        $view = dirname(__DIR__, 2) . '/layout/auth/auth.layout.php';
        $this->render(
            $view,
            [
                "authForm" => dirname(__DIR__, 2) . "/components/form/register/register.component.php",
                "pageTitle" => "Register",
            ],
        );
        require_once $view;
    }

    #[Route('/register', name: 'registerToDatabase', methods: ['POST'])]
    public function registerToDatabase()
    {
        //
    }
}