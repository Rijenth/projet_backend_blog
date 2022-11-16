    <?php
    /** @var App\Entity\Post[] $posts */
    foreach ($posts as $post) {
        echo $post->getContent();
    }

    $username =  filter_input(INPUT_POST, "username");
    $password =  filter_input(INPUT_POST, "password");
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $firstName = filter_input(INPUT_POST, "firstName");
    $lastName = filter_input(INPUT_POST, "lastName");
    $gender = filter_input(INPUT_POST, "gender");

    $roles = filter_input(INPUT_POST, "gender");
    $roles = ["admin", "modo", "simpe"];

    $user = new \App\Entity\User();
    $user->setRoles($roles);
    var_dump($user->getRoles());


    ?>

    <h1>Bienvenue sur ce magnifique blog</h1>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Home</title>
    </head>
    <body>

    <h1>Inscription : </h1>
    <form method="post" action="#">

        <label for="email">Email :
            <input type="email" name="email">
        </label>

        <label for="username">Username :
            <input type="text" name="username">
        </label>

        <label for="firstName">
            <input type="text" name="firstName">
        </label>

        <label for="lastName">
            <input type="text" name="lastName">
        </label>

        <label for="gender">Gender:
            <select name="gender">
                <option value="">--Please select a gender--</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </label>

        <label for="password">Password :
            <input type="password" name="password">
        </label>


        <label for="confirm">Confirm password :
            <input type="password" name="confirm">
        </label>

        <label for="admin">Admin ?
            <input type="checkbox" name="admin"/>
        </label>

        <label for="moderator">Moderator ?
            <input type="checkbox" name="moderator"/>
        </label>

        <label for="simple">Simple ?
            <input type="checkbox" name="simple"/>
        </label>

        <button>Envoyer</button>
    </form>

    <hr>

    <h1>Connexion : </h1>
    <form method="post" action="#">
        <label for="username">Username :</label>
        <input type="text" name="username">

        <label for="password">Password :</label>
        <input type="password" name="password">

        <button>Envoyer</button>
    </form>

    </body>
    </html>




