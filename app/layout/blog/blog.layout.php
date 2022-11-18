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
    <div class="profile">
        <div class="profile__info">
            <h1 class="profile__name">
                <? echo $_SESSION['user'] ?>
            </h1>

        </div>
    </div>

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

    // get all posts
    const postsWrapper = document.querySelector('.blog_posts-wrapper');
    const renderPosts = () => {
        fetch('/api/posts')
            .then(response => response.json())
            .then(data => {
                data.forEach(post => {
                    // each post is currently in a string we need to convert it to an object
                    const postObj = JSON.parse(post);
                    // create a new div for each post
                    const postDiv = document.createElement('div');
                    postDiv.classList.add('blog_post');
                    // create a new h3 for each post
                    const postTitle = document.createElement('h3');
                    postTitle.classList.add('blog_post-title');
                    postTitle.innerText = postObj.title;
                    // create a new p for each post
                    const postContent = document.createElement('p');
                    postContent.classList.add('blog_post-content');
                    postContent.innerText = postObj.content;
                    // create a new p for each post
                    const postAuthor = document.createElement('p');
                    postAuthor.classList.add('blog_post-author');
                    postAuthor.innerText = postObj.author;
                    // append the elements to the post div
                    postDiv.appendChild(postTitle);
                    postDiv.appendChild(postContent);
                    postDiv.appendChild(postAuthor);
                    // append the post div to the posts wrapper
                    postsWrapper.appendChild(postDiv);

                })

            })
    }

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
            }).then(() => {
                // empty form
                postForm.title.value = '';
                postForm.content.value = '';
                // empty the posts wrapper
                document.querySelector('.blog_posts-wrapper').innerHTML = '';
                // fetch all posts
                renderPosts();
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
    renderPosts();
    </script>
</body>

</html>