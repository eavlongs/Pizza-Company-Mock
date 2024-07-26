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

    function getID() {
        if (isset($_GET["item-id"])) {
         return $_GET["item-id"];
        }
     }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pizza Company</title>
    <?php
      include "php/head.php";
    ?>
    <link rel="stylesheet" href="css/style.css?<? echo time()?>">
    <script
    src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
    crossorigin="anonymous"></script>
    <script src="scripts/cart.js"></script>
  </head>
  <body>
    <!-- Header -->
    <?php
      // Choose any of these options for coloring the tab red: "home", "pizza", "puff", "lunch", "aptz", "pasta", "salad", "promo", "bev", "icc"
      include "php/nav.php";
    ?>

    <?php
        $item_id = getID();
        $mysql = "SELECT * FROM shop_items WHERE shop_items.item_id = $item_id;";
        $result = $conn->query($mysql);
        $row = mysqli_fetch_assoc($result);
        echo '<div style="margin-top: 60px" class="block-center1">
          <img class="item-image" src="'.$row['item_img'].'" />
          <div class="cart1">
          <h1 class="capitalize">'.$row['item_name'].'</h1>

            <button id="to-cart" onclick="addToCart('.$row['item_id'].')">
              <div class="cart1 two">
              <h2>'.$row['item_price'].' USD</h2>
              <img src="images//shopping-cart.png" />
              </div>
            </button>
          </div>
        </div>'
    ?>

    <script>
      $("#to-cart").click(function(){
        $.ajax({
        type: "POST",
        url: 'item.php',
        data: {itemID: <?= $row['item_id']?>},
        success: function(msg){
        $('.answer').html(msg);
        }
        }).done(function(response){
            console.log("SENT TO PHP");
        });
      })
    </script>
    <footer>
      <?php
        include "php/footer.php";
      ?>
    </footer>
  </body>
  <?php
    // close connection to database
    $conn->close();
  ?>
</html>
