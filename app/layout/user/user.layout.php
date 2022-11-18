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
    </main>
    <script>
    // test the fetch to /api/user/{user_id}

    const userId = <?php echo $args['userId'] ?>;
    const url = `/api/user/${userId}`;

    let notFound = false;
    let username;
    let email;
    let firstName;
    let lastName;
    let gender;

    // if json parse fails, it means the user was not found
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                notFound = true;
                throw new Error(data.error);
            }
            username = data.username;
            email = data.email;
            firstName = data.firstName;
            lastName = data.lastName;
            gender = data.gender;
            createProfile();
        })
        .catch((error) => {
            if (notFound) {
                console.log("User not found");
            } else {
                console.log(error);
            }
        });

    function createProfile() {
        const userPage = document.getElementById("user-page");

        const profile = document.createElement("div");
        profile.classList.add("profile");

        const profileUsername = document.createElement("h2");
        profileUsername.classList.add("profile-username");
        profileUsername.innerText = username;

        const profileEmail = document.createElement("p");
        profileEmail.classList.add("profile-email");
        profileEmail.innerText = email;

        const profileFirstName = document.createElement("p");
        profileFirstName.classList.add("profile-first-name");
        profileFirstName.innerText = firstName;

        const profileLastName = document.createElement("p");
        profileLastName.classList.add("profile-last-name");
        profileLastName.innerText = lastName;

        const profileGender = document.createElement("p");
        profileGender.classList.add("profile-gender");
        profileGender.innerText = gender;

        profile.appendChild(profileUsername);
        profile.appendChild(profileEmail);
        profile.appendChild(profileFirstName);
        profile.appendChild(profileLastName);
        profile.appendChild(profileGender);

        userPage.appendChild(profile);

        console.log("Profile created");
    }
    </script>
</body>

</html>