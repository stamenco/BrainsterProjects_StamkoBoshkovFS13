import { path, danger, success } from "./modules.js";
$(function () {
  $("#signInAction").on("click", function (e) {
    e.preventDefault();
    let email = $("#email").val();
    let password = $("#password").val();
    $.post(path + "source/actions/Auth/login.php", {
      process: "authLogin",
      email,
      password,
    })
      .then(function (response) {
        let data = JSON.parse(response);

        if (data.auth) {
          success("You were successfully logged in");
          setTimeout(() => {
            location.href = path + "home";
          }, 2000);
        } else {
          danger("Wrong credentials");
        }
      })
      .catch(() => {
        setTimeout(() => {
          location.href = path + "broken";
        }, 1500);
      });
  });
});
