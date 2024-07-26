function signUp() {
  let firstname = $("#fname").val();
  let lastname = $("#lname").val();
  let email = $("#email").val();
  let pwd = $("#pwd").val();
  let phone = $("#phone").val();
  let postObj = {
    name: firstname + " " + lastname,
    email: email,
    password: pwd,
    phone: phone,
  };
  var username = firstname + " " + lastname;
  $.ajax({
    type: "POST",
    data: { userData: JSON.stringify(postObj) },
    url: "signups.php",
    success: function (response) {
      var jsonData = JSON.parse(response);
      if (jsonData.success) {
        document.cookie =
          "username=" + username + "; expires=Mon, 18 Dec 2023 12:00:00 UTC";
        window.location.href = "index.php";
      } else {
        $("#user-exist").css("display", "block");
      }
    },
  });
}
