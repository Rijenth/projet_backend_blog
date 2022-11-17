// get the argument from the url
const urlParams = new URLSearchParams(window.location.search);

// if the argument is not empty
if (urlParams.has("token")) {
  // log the argument
  console.log(urlParams.get("token"));
}
