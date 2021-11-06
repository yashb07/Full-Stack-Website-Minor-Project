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

function iframeLoaded() {
  var iFrameID = document.getElementById('comment_iframe');
  if(iFrameID) {
        // here you can make the height, I delete it first, then I make it again
        iFrameID.height = "";
        iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
  }   
}