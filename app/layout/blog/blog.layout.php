<?php
// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
}
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
    <link rel="stylesheet" href="../../styles/globals.css" />

</head>

<body>

    <main id="blog_page">
        <div class="blog_posts-wrapper">
            <div class="blog_post">
                <h3 class="blog_post-title">
                    Post test
                </h3>
                <p class="blog_post-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor at fuga ut
                    consectetur magni nesciunt consequatur cum amet obcaecati vel facilis quisquam exercitationem, illum
                    incidunt delectus ducimus impedit! Quo, consequatur!</p>
            </div>
        </div>
        <?php var_dump($_SESSION) ?>
    </main>
    <script>
    const current_user = <?php echo json_encode($_SESSION['user']) ?>;
    </script>
</body>

</html>