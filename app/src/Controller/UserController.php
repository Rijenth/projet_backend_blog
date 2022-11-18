<?php

namespace App\Controller;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Route\Route;

class UserController extends AbstractController
{
    public function home()
    {
        $manger = new UserManager(new PDOFactory());
        $user = $manger->getAllUsers();

        $this->render("home.php", ["posts" => $user], "Tous les posts");
    }


    #[Route('/api/register', name: 'createUser', methods: ['POST'])]
    public function createUser()
    {
        $user = new User($_POST);

        $manager = new UserManager(new PDOFactory());

        try {
            $manager->register($user);
        } catch (\PDOException $e) {
            return http_response_code(500);
        }

        return http_response_code(201);
    }
}