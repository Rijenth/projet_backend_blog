const userNameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");

const form = document.getElementsByClassName("form_login")[0];

form.addEventListener("submit", (e) => {
  if (userNameInput.value === "" || passwordInput.value === "") {
    e.preventDefault();
    alert("Please fill out all fields");
  }
});
