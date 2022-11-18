<?php
// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
}
$tempId = 70;
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
    <a href="/logout" class="logout-btn">
        Logout
    </a>

    <main id="blog_page">
        <!-- Form to create a post -->
        <form action="/api/posts/create" method="POST" class="post-form">
            <input type="text" name="title" placeholder="Title" />
            <textarea name="content" placeholder="Content"></textarea>
            <button class="form_action" type="submit">Create</button>
        </form>
        <div class="blog_posts-wrapper">
            <div class="blog_post">
                <h3 class="blog_post-title">
                    Post test
                </h3>
                <p class="blog_post-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor at fuga ut
                    consectetur magni nesciunt consequatur cum amet obcaecati vel facilis quisquam exercitationem, illum
                    incidunt delectus ducimus impedit! Quo, consequatur!
                </p>
                <p class="blog_post-author">
                    <? echo $_SESSION['user'] ?>
                </p>
                <?php
                //if session role is admin or moderator show delete button
                if ($_SESSION['roles'] == 'admin' || $_SESSION['roles'] == 'moderator') {
                    echo '<button class="delete-btn"
                    onclick="deletePost(' . $tempId . ')">Delete</button>';
                }
                ?>

            </div>
        </div>
    </main>
    <script>
    const current_user = <?php echo json_encode($_SESSION['userid']) ?>;

    // create post
    const postForm = document.querySelector('.post-form');
    postForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('title', postForm.title.value);
        formData.append('content', postForm.content.value);
        formData.append('author', current_user);
        fetch('/api/posts/create', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })

    })

    // get all posts
    const postsWrapper = document.querySelector('.blog_posts-wrapper');
    fetch('/api/posts')
        .then(response => response.json())
        .then(data => {
            data.forEach(post => {
                const postElement = document.createElement('div');
                postElement.classList.add('blog_post');
                postElement.innerHTML = `
                <h3 class="blog_post-title">
                    ${post.title}
                </h3>
                <p class="blog_post-content">
                    ${post.content}
                </p>
                <p class="blog_post-author">
                    ${post.author}
                </p>
                <button class="delete-btn"
                    onclick="deletePost(${post.id})">Delete</button>
                `;
                postsWrapper.appendChild(postElement);
            })
        })

    // delete post
    function deletePost(id) {
        fetch(`/api/posts/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
    }
    </script>
</body>

</html>