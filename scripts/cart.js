function addToCart(ID) {
  var existingID = JSON.parse(localStorage.getItem("ID"));
  if (existingID == null) existingID = [];
  var quantity = JSON.parse(localStorage.getItem("quantity"));
  if (quantity == null) quantity = [];
  var alreadyInCart = false;
  // Save allEntries back to local storage
  var h1tag = document.getElementsByTagName("h1")[0];
  var imgSrcInH1 = h1tag.getElementsByTagName("img");
  if (imgSrcInH1.length == 0) {
    h1tag.innerHTML +=
      " <img src='images/green-tick.png' width='30' height='30'>";
  }
  existingID.forEach((arrID) => {
    if (arrID == ID) {
      alert("Item is already in cart.");
      alreadyInCart = true;
    }
  });

  if (!alreadyInCart) {
    existingID.push(ID);
    localStorage.setItem("ID", JSON.stringify(existingID));
    setCookie("ID");
    quantity.push(1);
    localStorage.setItem("quantity", JSON.stringify(quantity));
  }
}

function removeAllCart() {
  localStorage.removeItem("ID");
}

var item_id, item_img, item_name, item_price;

function constructCart() {
  var quantity = JSON.parse(localStorage.getItem("quantity"));
  var cartDivTag = document.getElementsByClassName("shopping-cart")[0];
  var allID = JSON.parse(localStorage.getItem("ID"));
  var htmlCode;
  if (allID == null || allID.length == 0) {
    htmlCode = "Cart is Empty";
    cartDivTag.innerHTML +=
      '<div class="cart-row"><h3>CART IS EMPTY</h3></div>';
    alert("No item is currently in cart");
  } else {
    for (var i = 0; i < item_img.length; i++) {
      cartDivTag.innerHTML += `<div class="cart-row hidden-id" data-id="${item_id[i]}">
      <div class="item-img">
        <img src="${item_img[i]}" />
      </div>
      <div class="item-detail">
        <p class="item-name capitalize">${item_name[i]}</p>
        <p class="item-price">(1): ${item_price[i]} USD</p>
        <span>Amount: </span>
        <input class="quantity" onchange="updateCartTotal()" type="number" value="${quantity[i]}" min="1" />
        <button class="remove cursor-pointer" onclick="removeCart(${item_id[i]})">REMOVE</button>
      </div>
    </div>`;
    }

    cartDivTag.innerHTML += `<div class="total-div">
    <span class="total">Total:</span>
    <span class="total amount" style="padding-left: 0px"> 0.00 USD</span>
    <button class="checkout cursor-pointer" onclick="checkout();">CHECKOUT</button>
  </div>`;
    if (getCookie("username") == null) {
      cartDivTag.innerHTML += `<p>Please log in before you checkout</p>`;
    }
    updateCartTotal();
  }
}

function removeCart(ID) {
  var parentDiv = document.getElementsByClassName("hidden-id");
  for (var i = 0; i < item_id.length; i++) {
    if (parentDiv[i].dataset.id == ID) {
      parentDiv[i].remove();
      var existingID = JSON.parse(localStorage.getItem("ID"));
      for (var i = 0; i < existingID.length; i++) {
        if (existingID[i] == ID) {
          for (var j = i; j < existingID.length - 1; j++) {
            var temp = existingID[j];
            existingID[j] = existingID[j + 1];
            item_id[j] = item_id[j + 1];
            existingID[j + 1] = temp;
            item_id[j + 1] = temp;
            var temp2 = item_price[j];
            item_price[j] = item_price[j + 1];
            item_price[j + 1] = temp2;
            var temp3 = item_img[j];
            item_img[j] = item_img[j + 1];
            item_img[j + 1] = temp3;
            var temp4 = item_name[j];
            item_name[j] = item_name[j + 1];
            item_name[j + 1] = temp4;
          }
          break;
        }
      }
      item_id.pop();
      item_name.pop();
      item_price.pop();
      item_img.pop();
      existingID.pop();
      localStorage.setItem("ID", JSON.stringify(existingID));
      setCookie("ID");
      updateCartTotal();
      return;
    }
  }
}

function setCookie(cookieName) {
  if (localStorage.getItem(cookieName) != null) {
    var jsonStr = localStorage.getItem(cookieName);
    document.cookie =
      cookieName + " = " + jsonStr + "; expires=Mon, 18 Dec 2023 12:00:00 UTC";
  }
}

function updateCartTotal() {
  var cartRows = document.getElementsByClassName("cart-row");
  var total = 0;
  var quanityArr = [];
  for (var i = 0; i < cartRows.length; i++) {
    var cartRow = cartRows[i];
    var priceElement = cartRow.getElementsByClassName("item-price")[0];
    var quantityElement = cartRow.getElementsByClassName("quantity")[0];
    var price = item_price[i];
    var quantity = quantityElement.value;
    quanityArr.push(quantity);
    total += price * quantity;
  }
  total = total.toFixed(2);
  localStorage.setItem("quantity", JSON.stringify(quanityArr));
  document.getElementsByClassName("amount")[0].innerText = "$" + total;
}

function checkout() {
  if (getCookie("username") == null) {
    window.location.href = "login.html";
  } else {
    window.location.href = "receipt.php";
    sendQuantity();
  }
}

function getCookie(user) {
  var cookieArr = document.cookie.split(";");
  for (var i = 0; i < cookieArr.length; i++) {
    var cookiePair = cookieArr[i].split("=");
    if (user == cookiePair[0].trim()) {
      return decodeURIComponent(cookiePair[1]);
    }
  }
  return null;
}

function writeReceipt() {
  var customerNameReal = getCookie("username");
  var customerNameHTML = document.getElementById("customer-name");
  customerNameHTML.innerText = customerNameReal;
  var date = document.getElementById("date");
  date.innerText = currentTime();
  var items = document.getElementsByClassName("info")[0];
  var quantity = JSON.parse(localStorage.getItem("quantity"));
  for (var i = 0; i < item_id.length; i++) {
    var price = item_price[i] * quantity[i];
    price = price.toFixed(2);
    items.innerHTML += `<div class="line">
    <p clas="floatLeft">-${quantity[i]} x ${item_name[i]}</p>
    <p class="floatRight price">$${price}</p>
  </div>`;
  }
  var total = 0;
  var priceClass = document.getElementsByClassName("price");
  for (var i = 0; i < priceClass.length; i++) {
    var price = priceClass[i].innerText;
    price = price.replace("$", "");
    price = parseFloat(price);
    total += price;
  }
  total = total.toFixed(2);
  var totalID = document.getElementsByClassName("total");
  totalID[0].innerText = "$" + total;
  totalID[1].innerText = "$" + total;
  var totalKHR = document.getElementsByClassName("total-khr")[0];
  var khr = total * 4100;
  khr = khr.toLocaleString("en-US");
  totalKHR.innerText = khr + " riels";
  localStorage.removeItem("ID");
  document.cookie =
    "ID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/pizza/Group%239_Section%234%20_Topic%23PizzaCompany";
  localStorage.removeItem("quantity");
}

function currentTime() {
  var date = new Date();
  var output = "";
  output +=
    date.getHours() +
    ":" +
    date.getMinutes() +
    ":" +
    date.getSeconds() +
    " " +
    date.getDate() +
    "/" +
    (date.getMonth() + 1) +
    "/" +
    date.getFullYear();
  return output;
}

function sendQuantity() {
  var quantityClass = document.getElementsByClassName("quantity");
  var quantityArr = [];
  for (var i = 0; i < quantityClass.length; i++) {
    var quantity = quantityClass[i].value;
    quantityArr.push(parseInt(quantity));
  }
  localStorage.setItem("quantity", JSON.stringify(quantityArr));
}
