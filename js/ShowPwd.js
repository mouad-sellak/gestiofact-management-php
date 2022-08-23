// $(function() {
//     var TxtOldPwd=$('.OldPwd');
//     $('.ShowOldPwd').hover(
//         function() {
//         TxtOldPwd.attr('type','text');
//         },
//         function() {
//             TxtOldPwd.attr('type','password');
//         }
//     )
// })
function ShowOldPwd() {
    var x = document.getElementById("OldPwd");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
function ShowNewPwd() {
    var x = document.getElementById("NewPwd");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
function ShowNewPwdConfi() {
    var x = document.getElementById("NewPwdConfi");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }