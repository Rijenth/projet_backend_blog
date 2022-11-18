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
        <?php if (isset($args['userId'])) : ?>
        <p>User id: <?php echo $args['userId'] ?></p>
        <?php endif; ?>
    </main>
    <script>
    // get user in url
    const url = window.location.href;
    const urlArray = url.split('/');
    const userId = urlArray[urlArray.length - 1];
    // get user from api
    fetch(`/api/user/${userId}`)
        .then(response => response.json())
        .then(user => {
            const userPage = document.getElementById('user-page');
            userPage.innerHTML = `
                <h1>${user.username}</h1>
                <h2>${user.firstName} ${user.lastName}</h2>
            `;
        });
    </script>
</body>

</html>