<?php

// Check if user is logged in
/* if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
}
// check cookies
if (!isset($_COOKIE['user'])) {
    header("Location: /login");
    exit();
} */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <? echo $args['pageTitle'] ?>
    </title>
</head>

<body>
    <main id="user-page">
        <h1>User profile</h1>
    </main>
    <script>
    // test the fetch to /api/user/{user_id}

    const userId = <?php echo $args['userId'] ?>;
    const url = `/api/user/${userId}`;
    fetch(url)
        .then((response) => response.json())
        .then((data) => console.log(data))
        .catch((error) => console.log(error));
    </script>
</body>

</html>