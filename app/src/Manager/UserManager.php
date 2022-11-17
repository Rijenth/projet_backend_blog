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

    public function UserNameExist($name, $email)
    {
        $query = $this->pdo->query("SELECT * FROM users WHERE username = ? OR email = ?;");
        $query->execute([$name, $email]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    function pwdMatch($password, $pwdcheck)
    {
        if ($password == $pwdcheck) {
            $result = false;
        } else {
            $result = true;
        }
    }

    /**
     * @return User[]
     */
    public function login($uid, $pwd): array
    {
        $uidExist = $this->UserNameExist($uid, $uid);

        if ($uidExist === false) {
            header("location: ../login.php?error=wrongLogin");
            exit();
        }
        $pwdHashed = $uidExist['password'];
        $checkPass = password_verify($pwd, $pwdHashed);


        if ($checkPass === false) {
            header("location: ../login.php?error=wrongLogin");
            exit();
        } else if ($checkPass === true) {
            session_start();
            $_SESSION["userid"] = $uidExist['id'];
            $_SESSION["useruid"] = $uidExist['username'];
            header("location: ../index.php");
            exit();
        }
        return $uidExist;
    }
}
