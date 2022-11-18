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
            <a href="/user/<?php echo $_SESSION['userid'] ?>">
                <h1 class="profile__name">
                    <? echo $_SESSION['user'] ?>
                </h1>
            </a>
        </div>
    </div>

    <main id="blog_page">
        <form action="/api/posts/create" method="POST" class="post-form">
            <input type="text" name="title" placeholder="Title" />
            <textarea name="content" placeholder="Content"></textarea>
            <button class="form_action" type="submit">Create</button>
        </form>
        <div class="blog_posts-wrapper">

        </div>
    </main>
    <script>
    const current_user = <?php echo json_encode($_SESSION['userid']) ?>;

    // get author
    const getAuthor = async (id) => {
        const response = await fetch(`/api/user/${id}`);
        const data = await response.json();
        //const user = JSON.parse(data);

        return data.username;
    }

    // get all posts
    const postsWrapper = document.querySelector('.blog_posts-wrapper');
    const renderPosts = () => {
        fetch('/api/posts')
            .then(response => response.json())
            .then(data => {
                data.forEach(post => {
                    // each post is currently in a string we need to convert it to an object
                    const postObj = JSON.parse(post);
                    const author_id = postObj.user_id;
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
                    // sadly we need to wait for getAuthor to finish before we can add the author to the post
                    getAuthor(author_id).then(author => {
                        postAuthor.innerText = author;
                    });
                    // add a delete btn if user is admin or moderator or if user is the author of the post
                    if (author_id == current_user ||
                        <?php echo json_encode($_SESSION['roles']) ?> ==
                        'admin' || <?php echo json_encode($_SESSION['roles']) ?> == 'moderator') {
                        const deleteBtn = document.createElement('button');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerText = 'Delete';
                        deleteBtn.addEventListener('click', () => {
                            deletePost(postObj.id);
                        });
                        postDiv.appendChild(deleteBtn);
                    }
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
        formData.append('user_id', current_user);
        fetch('/api/posts/create', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })

        // if the above code works we need to clear the form
        // empty form
        postForm.title.value = '';
        postForm.content.value = '';
        // empty the posts wrapper
        document.querySelector('.blog_posts-wrapper').innerHTML = '';
        // fetch all posts
        renderPosts();

    })



    // delete post
    function deletePost(id) {
        fetch(`/api/posts/${id}`, {
            method: 'DELETE'
        })
        // if the above code works we need to clear the form
        // empty form
        postForm.title.value = '';
        postForm.content.value = '';
        // empty the posts wrapper
        document.querySelector('.blog_posts-wrapper').innerHTML = '';
        // fetch all posts
        renderPosts();
    }
    renderPosts();
    </script>
</body>

</html>