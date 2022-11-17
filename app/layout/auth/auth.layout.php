<?php
// This page is the layout of both the login and register pages
// the title of the page is set in the controller
echo 'pute'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $_pageTitle; ?>
    </title>
</head>

<body>
    <main id="auth_page">
        <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1519680773-8b8b0b0e1b1a?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YmFja2dyb3VuZHxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80"
                alt="background image">
        </div>
        <div class="form-wrapper">
            <!-- Un des deux formulaire dispo dans components/form -->
            <?= $_pageContent; ?>
        </div>
    </main>
</body>

</html>