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

function modale(modal, span) {
  var btn = document.getElementById("myBtn");
  modal.style.display = "block";

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}

function createModal(post){
  console.log(post);
  if (document.getElementById("postModal")){
    document.getElementById("postModal").parentNode.removeChild(document.getElementById("postModal"));
  }
  var modal = document.createElement("div");
  var content = document.createElement("div");
  var span = document.createElement("span");
  var form = document.createElement("form");
  var div2 = document.createElement("div");
  var textarea = document.createElement("textarea");
  var p = document.createElement("p");
  var submit = document.createElement("input");

  modal.setAttribute("id", "postModal");
  modal.setAttribute("class", "modal");
  content.setAttribute("class", "modal-content");
  span.setAttribute("class", "close");
  form.setAttribute("id", "edit");
  form.setAttribute("name", "edit");
  form.setAttribute("method", "post");
  form.setAttribute("action", "accedit.php");
  form.setAttribute("onsubmit", "return checkPost(edit, editerror)");
  textarea.setAttribute("id", "contentedit");
  textarea.setAttribute("type", "text");
  textarea.setAttribute("name", "content");
  textarea.setAttribute("placeholder", "Voorbeeld...");
  p.setAttribute("id", "editerror");
  submit.setAttribute("class", "myButton");
  submit.setAttribute("type", "submit");
  submit.setAttribute("name", "submit");
  submit.setAttribute("value", "Veranderen");

  textarea.required = "required";

  span.innerHTML = "&times;";
  textarea.value = post.innerHTML;

  document.body.appendChild(modal);
  modal.appendChild(content);
  content.appendChild(span);
  content.appendChild(form);
  form.appendChild(div2);
  div2.appendChild(textarea);
  div2.appendChild(p);
  form.appendChild(submit);
  console.log(post.children);
  modale(postModal, document.getElementsByClassName("close")[0]);

}

// <div id="postModal" class="modal">
//   <div class="modal-content">
//     <span class="close">&times;</span>
//     <form name="post" id="post" method="post" action="post.php" onsubmit="return checkPost(post)">
//       <div>
//         <textarea id="modalcont" required type="text" name="content" placeholder="Example..."></textarea>
//         <p id="posterror"></p>
//       </div>
//       <input class="myButton" type="submit" name="submit" value="Post">
//     </form>
//   </div>
// </div>
