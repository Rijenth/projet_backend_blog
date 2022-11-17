<main id="blog_page">
    <div class="posts">
        <!-- Liste des postes -->
        <?= $_pageContent; ?>
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