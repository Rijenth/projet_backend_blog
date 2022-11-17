const usernameInput = document.getElementsByClassName(
  "form_register_username-input"
)[0];
const firstNameInput = document.getElementsByClassName(
  "form_register_first-name-input"
)[0];
const lastNameInput = document.getElementsByClassName(
  "form_register_last-name-input"
)[0];
const emailInput = document.getElementsByClassName(
  "form_register_email-input"
)[0];
const passwordInput = document.getElementsByClassName(
  "form_register_password-input"
)[0];
const passwordConfirmInput = document.getElementsByClassName(
  "form_register_password-confirm-input"
)[0];
const genderInput = document.getElementsByClassName(
  "form_register_gender-inputs"
)[0];
const isAdminInput = document.getElementsByClassName(
  "form_register_is-admin-input"
)[0];
const isModeratorInput = document.getElementsByClassName(
  "form_register_is-moderator-input"
)[0];
const isSimpleUserInput = document.getElementsByClassName(
  "form_register_is-simple-user-input"
)[0];
const form = document.getElementsByClassName("form_register")[0];

const errorMsg = document.getElementsByClassName("form_register_error-msg")[0];

// add event listener to the form
// if any input is empty, disable the submit button

form.addEventListener("submit", (e) => {
  if (
    usernameInput.value === "" ||
    firstNameInput.value === "" ||
    lastNameInput.value === "" ||
    emailInput.value === "" ||
    passwordInput.value === "" ||
    passwordConfirmInput.value === ""
  ) {
    e.preventDefault();
    errorMsg.innerHTML = "Please fill out all fields";
  }
  // if the password and password confirm inputs don't match, change the error message
  if (passwordInput.value !== passwordConfirmInput.value) {
    e.preventDefault();
    errorMsg.innerHTML = "Passwords don't match";
  }
  // add regex to check if the email is valid
  // if it's not, change the error message
  if (!emailInput.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
    e.preventDefault();
    errorMsg.innerHTML = "Please enter a valid email";
  }
  // regex for password
  // if it's not valid, change the error message
  if (
    !passwordInput.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/)
  ) {
    e.preventDefault();
    errorMsg.innerHTML =
      "Password must contain at least 8 characters, one uppercase letter, one lowercase letter and one number";
  }
});
