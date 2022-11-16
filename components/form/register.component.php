<h1>Inscription : </h1>
<form method="post" action="#">

    <label for="email">Email :
        <input type="email" name="email">
    </label>

    <label for="username">Username :
        <input type="text" name="username">
    </label>

    <label for="firstName">
        <input type="text" name="firstName">
    </label>

    <label for="lastName">
        <input type="text" name="lastName">
    </label>

    <label for="gender">Gender:
        <select name="gender">
            <option value="">--Please select a gender--</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </label>

    <label for="password">Password :
        <input type="password" name="password">
    </label>


    <label for="confirm">Confirm password :
        <input type="password" name="confirm">
    </label>

    <label for="admin">Admin ?
        <input type="checkbox" name="admin" />
    </label>

    <label for="moderator">Moderator ?
        <input type="checkbox" name="moderator" />
    </label>

    <label for="simple">Simple ?
        <input type="checkbox" name="simple" />
    </label>

    <button>Envoyer</button>
</form>