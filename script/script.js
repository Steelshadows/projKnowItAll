function validatePassword(){
  var signup = document.getElementById('passwordsignup').value;
  var check = document.getElementById('passwordCheck').value
  console.log(signup);
  console.log(check);
  if(signup == check){
      return true;
  }
  else{
    alert('passwords are not the same');
    return false;
  }
}
