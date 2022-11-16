<?
// This is a component for the post
// It will get a $usrename, $blogTitle, $blogContent

?>

<div class="post">
    <div class="post-content-wrapper">
        <h2 class="post-title"><?= $blogTitle; ?></h2>
        <p class="post-content">
            <?= $blogContent; ?>
        </p>
    </div>
    <p class="post-author">@<?= $username; ?></p>
    <div class="comments">
        <h3>Comments :</h3>
        <div class="comments-wrapper">
            <!-- Liste des commentaires en utilisant ./comment.php -->
        </div>
        <form method="post" action="#">
            <label for="comment">Comment :</label>
            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
            <button>Envoyer</button>
        </form>
    </div>
</div>