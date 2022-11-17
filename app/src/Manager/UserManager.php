<?php

namespace App\Manager;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Interfaces\Database;

class UserManager extends BaseManager
{

    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        $query = $this->pdo->query("select * from User");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function register(User $user): void
    {
        $query = $this->pdo->prepare("INSERT INTO User (username, password, email, firstName, lastName, gender, roles) VALUES (:username, :password, :email, :firstName, :lastName, :gender, :roles)");
        
        $query->execute([
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password" => $user->getHashedPassword(),
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "gender" => $user->getGender(),
            "roles" => $user->getRole(),
        ]);
    }    
}