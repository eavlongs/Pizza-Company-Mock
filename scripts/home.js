function signOut() {
  document.cookie =
    "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/pizza/Group%239_Section%234%20_Topic%23PizzaCompany";
}

function displayNone(id) {
  var element = document.getElementById(id);
  element.style.display = "none";
}
