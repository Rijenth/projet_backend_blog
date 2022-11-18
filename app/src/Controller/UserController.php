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

    #[Route('/api/user/{user_id}', name: 'getSingleUser', methods: ['GET'])]
    public function getSingleUser(string $user_id): array
    {
        $manager = new UserManager(new PDOFactory());

        try {
            $user = $manager->getSingleUser(["user_id" => $user_id]);
        } catch (\PDOException $e) {
            return http_response_code(500);
        }

        return $user->dataToArray();
    }
    #[Route('/api/login', name: 'createUser', methods: ['POST'])]
    public function loginUser()
    {
        $user = new User();
        $manager = new UserManager(new PDOFactory());
        $user2 = $manager->UserNameExist();
        $manager->login($user);

        var_dump($user2);
    }
}
