const userNameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");

const form = document.getElementsByClassName("form_login")[0];

form.addEventListener("submit", (e) => {

  if (userNameInput.value === "" || passwordInput.value === "") {
    e.preventDefault();

    alert("Please fill out all fields");
  }
  // if it was the button to go to register page, redirect to register page and preventDefault
  if (e.submitter.id === "register") {
    e.preventDefault();

    window.location.href = "/register";
  }

  /*fetch("/api/login", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      username: userNameInput.value,
      password: passwordInput.value,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.error) {
        alert(data.error);
      } else {
        window.location.href = "/";
      }
    });*/
});
