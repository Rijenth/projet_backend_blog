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

    public function UserNameExist(User $user)
    {
        $query = $this->pdo->query("SELECT * FROM users WHERE username = ?;");
        $query->execute([
            "username" => $user->getUsername(),
        ]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function login(User $user,$uid, $pwd)
    {
        $uidExist = $this->UserNameExist($uid);

        if ($uidExist === false) {
            header("location: ../login.php?error=wrongLogin");
            exit();
        }
        $pwdHashed = $user->getHashedPassword();
        $checkPass = password_verify($pwd, $pwdHashed);


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
        $query = $this->pdo->prepare("INSERT INTO User (username, email, password) VALUES (:username, :email, :password)");
        $query->execute([
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password" => $user->getHashedPassword(),

        ]);
    }
}