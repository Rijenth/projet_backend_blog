<form method="post" action="#" class="form_register">
    <h1>Inscription : </h1>

    <label for="email">Email :
        <input class="form_register_email-input" type="email" name="email">
    </label>

    <label for="username">Username :
        <input class="form_register_username-input" type="text" name="username">
    </label>

    <label for="firstName"> First Name :
        <input class="form_register_first-name-input" type="text" name="firstName">
    </label>

    <label for="lastName"> Last Name :
        <input class="form_register_last-name-input" type="text" name="lastName">
    </label>

    <label for="gender">Gender:
        <select name="gender" class="form_register_gender-inputs">
            <option value="">--Please select a gender--</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </label>

    <label for="password">Password :
        <input class="form_register_password-input" type="password" name="password">
    </label>


    <label for="confirm">Confirm password :
        <input class="form_register_password-confirm-input" type="password" name="confirm">
    </label>

    <label for="admin">Admin ?
        <input class="form_register_is-admin-input" type="checkbox" name="admin" />
    </label>

    <label for="moderator">Moderator ?
        <input class="form_register_is-moderator-input" type="checkbox" name="moderator" />
    </label>

    <label for="simple">Simple ?
        <input class="form_register_is-simple-user-input" type="checkbox" name="simple" />
    </label>
    <p class="form_register_error-msg"></p>
    <button type="submit" class="form_register_submit-btn">Envoyer</button>
</form>