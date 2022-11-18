<?php
// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
}
// check cookies
if (!isset($_COOKIE['user'])) {
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
</head>

<body>

    <main id="blog_page">
        <h2>
            <? echo $args['pageTitle'] ?>
        </h2>
        <div class="blog_posts-wrapper">

        </div>
    </main>
    <script>
    const current_user = <?php echo json_encode($_SESSION['user']) ?>;
    fetch('/api/posts')
        .then(response => response.json())
        .then(posts => {
            for (post of posts) {
                const postElement = document.createElement('div');
                postElement.classList.add('blog_post');
                if (post.user_id == current_user.id) {
                    postElement.classList.add('blog_post--current-user');
                }
                postElement.innerHTML = `
                    <div class="blog_post-header">
                        <h3>${post.title}</h3>
                        <p>${post.content}</p>
                    </div>
                    `;
                // If the post is from the current user, add a delete button
                if (post.user_id == current_user.id) {
                    const deleteButton = document.createElement('button');
                    deleteButton.classList.add('blog_post-delete');
                    deleteButton.innerHTML = 'Delete';
                    deleteButton.addEventListener('click', () => {
                        fetch(`/api/post/delete/${post.id}`, {
                                method: 'DELETE'
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Remove the post from the DOM
                                    postElement.remove();
                                }
                            })
                    })
                    postElement.appendChild(deleteButton);
                }
                document.querySelector('.blog_posts-wrapper').appendChild(postElement);
            }
        })
    </script>
</body>

</html>