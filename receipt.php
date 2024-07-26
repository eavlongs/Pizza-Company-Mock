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
<html>
  <head>
    <title>Pizza Company - Receipt</title>
    <?php include "php/head.php"?>
    <link rel="stylesheet" href="css/receipt.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="scripts/cart.js"></script>
  </head>


  <body onload="setCookie('ID'); writeReceipt()">
    <?php
      include "php/nav.php";
      if (isset($_COOKIE['ID'])){
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
    </script>

    <!-- End of navigation -->

    <!-- Start of receipt -->
    <div class="block-center">
      <div class="receipt">
        <p>RECEIPT</p>
        <div class="order-info">
          <div class="line">
            <p class="floatLeft">CUSTOMER'S NAME:</p>
            <p class="floatRight" id="customer-name"></p>
          </div>
          <div class="line">
            <p class="floatLeft">order for:</p>
            <p class="overflow">delivery</p>
          </div>
          <div class="line">
            <p class="floatLeft">TIME:</p>
            <p class="floatRight" id="date"></p>
          </div>
          <div class="line">
            <p class="floatLeft">ITEMS:</p>
          </div>
          <div class="info"></div>
          <div class="line">
            <p class="floatLeft">TOTAL COST:</p>
          </div>
          <div class="info">
            <div class="line">
              <p class="floatLeft">subtotal:</p>
              <p class="floatRight total">$0.00</p>
            </div>
            <div class="line">
              <p class="floatLeft">DELIVERY FEE:</p>
              <p class="floatRight">$0.00</p>
            </div>
            <div class="line">
              <p class="floatLeft">order total:</p>
              <p class="floatRight total">$0.00</p>
            </div>
            <div class="line">
              <p class="floatLeft">EXCHANGE RATE:</p>
              <p class="floatRight">4,100 RIELS</p>
            </div>
            <div class="line">
              <p class="floatLeft">IN KHR:</p>
              <p class="floatRight total-khr"> RIELS</p>
            </div>
          </div>
        </div>
        <div class="line">
          <p class="text-center">Thank you for ordering</p>
          <p class="text-center">Your order will be delivered in 30 minutes</p>
        </div>
      </div>
    </div>
    <footer><?php include "php/footer.php" ?>
  </body>
</html>
