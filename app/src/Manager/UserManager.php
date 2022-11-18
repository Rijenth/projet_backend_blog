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
        $query = $this->pdo->query("SELECT * FROM User");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }

        return $users;
    }
    
    public function getSingleUser(array $data): User
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE id = :id");

        $query->execute([
            "id" => $data['user_id'],
        ]);

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        $user = new User($data);

        return $user;
    }

    public function UserNameExist():bool
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE username = :username");
        $query->execute([
             "username" => "faust"
        ]);
        $data = $query->fetch(\PDO::FETCH_ASSOC);
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function login(User $user)
    {
        $uidExist = $this->UserNameExist();
        $alluid = $this->getAllUsers();
        var_dump($alluid);

        if ($uidExist === false) {
            header("location: ../login.php?error=wrongLogin");
            exit();
        }
        $checkPass = $user->passwordMatch();


        if ($checkPass === false) {
            header("location: ../login.php?error=wrongLogin");
            exit();
        } else if ($checkPass === true) {
            session_start();
            $_SESSION["userid"] = $user->getId();
            $_SESSION["useruid"] = $user->getUsername();
            header("location: /");
            exit();
        }
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