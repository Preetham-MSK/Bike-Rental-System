var password = document.getElementById("passwd")
  , confirm_password = document.getElementById("cpasswd");

function validatePassword(){
  if(passwd.value != cpasswd.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;