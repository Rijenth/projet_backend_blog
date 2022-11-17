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

    <main id="blog_page">
        <div class="posts">
            <!-- Liste des postes -->
        </div>
        <div class="form-wrapper">
            <form method="post" action="#">
                <label for="title">Title :</label>
                <input type="text" name="title">

                <label for="content">Content :</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>

                <button>Envoyer</button>
            </form>
        </div>
    </main>
</body>

</html>