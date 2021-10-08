function showPass() {
  var eye = document.getElementById("showPass");
  var x = document.getElementById("myPass");
  if (x.type === "password") {
    x.type = "text";
    eye.classList.remove("fa-eye-slash");
  } else {
    x.type = "password";
    eye.classList.add("fa-eye-slash");
  }
}
