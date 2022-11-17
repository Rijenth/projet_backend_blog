<?php

namespace App\Controller;

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
}
