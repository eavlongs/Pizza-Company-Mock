<?php
    // connect to database server
    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "pizza";

    $conn = new mysqli($serverName, $userName, $userPassword, $dbName);
    if ($conn -> connect_error) {
        die ("404 Database not found");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shopping Cart</title>
  <?php include "php/head.php"?>
  <link rel="stylesheet" href="css/style.css?<? echo time()?>"/>
  <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
  <script src="scripts/cart.js" async></script>
</head>

<body onload="setCookie('ID'); constructCart();">
  <!-- <script>
    var itemID = JSON.parse(localStorage.getItem("ID"));
    console.log(typeof(itemID));
    console.log(itemID);
    $.ajax({
    type: "POST",
    url: 'cart.php',
    data: {ID: JSON.stringify(itemID)},
    success: function(msg){
     $('.answer').html(msg);
    }
    }).done(function(response){
         console.log("SENT TO PHP");
    });
  //   contentType: "application/json; charset=utf-8",
  //   dataType: "json",
  //   error: function() {
  //     alert("Error");
  //   },
  //   success: function() {
  //     alert("OK");
  //   }
  // });
  </script> -->

  <?php
    include "php/nav.php";
    // $id = json_decode($_POST['ID']);
    // if (empty($id)){
    //   echo 'id is empty';
    // }
    // else {
    //   var_dump($id);
    // }
    if (isset($_COOKIE['ID']) || $_COOKIE == 'null'){
      $item_id = $_COOKIE['ID'];
      $item_id = json_decode($item_id, true);
      if($item_id != "null"){
        $img = array(); $itemName = array(); $price = array();
        foreach ($item_id as $id){
          $mysql = "SELECT * FROM shop_items WHERE shop_items.item_id = $id;";
          $result = $conn->query($mysql);
          $row = mysqli_fetch_assoc($result);
          array_push($img, $row['item_img']);
          array_push($itemName, $row['item_name']);
          array_push($price, $row['item_price']);
        }
      }
    }
  ?>

  <script>
    item_id = <?php echo json_encode($item_id);?>;
    item_img = <?php echo json_encode($img); ?>;
    item_name = <?php echo json_encode($itemName); ?>;
    item_price = <?php echo json_encode($price); ?>;
    // createCart();
  </script>

    <div class="shopping-cart">
      <h2>My cart</h2>
      <!-- <div class="cart-row">
        <div class="item-img">
          <img src="images/pasta1.png"/>
        </div>
        <div class="item-detail">
          <p class="item-name">Pasta</p>
          <p class="item-price">(1): 5.70 USD</p>
          <span>Amount: </span>
          <input class="quantity" type="number" value="1" min="1"/>
          <button class="remove">REMOVE</button>
        </div>
      </div> -->
      <!-- <div class="total-div">
        <span class="total">Total: 5.70 USD</span>
        <button class="checkout">CHECKOUT</button>
      </div> -->
    </div>
  <br>
  <footer>
    <?php include "php/footer.php"?>
  </footer>
  <?php
    // close connection to database
    $conn->close();
  ?>
</body>

</html>