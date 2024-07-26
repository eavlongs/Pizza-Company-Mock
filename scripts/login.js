function Login() {
  let email = $("#email").val();
  let pwd = $("#pwd").val();
  let postObj = {
    email: email,
    password: pwd,
  };
  $.ajax({
    type: "POST",
    data: { userData: JSON.stringify(postObj) },
    url: "logins.php",
    success: function (response) {
      var jsonData = JSON.parse(response);
      console.log(jsonData);
      if (jsonData.success) {
        document.cookie =
          "username=" +
          jsonData.username +
          "; expires=Mon, 18 Dec 2023 12:00:00 UTC";
        window.location.href = "index.php";
      } else {
        $("#wrong-info").css("display", "block");
      }
    },
  });
}
