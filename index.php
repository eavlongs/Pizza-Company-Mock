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
    <title>Pizza Company</title>
    <?php
      include "php/head.php";
    ?>
    <link rel="stylesheet" href="css/style.css?<? echo time()?>">
  </head>
  <body>
    <!-- Navigation -->
    <?php
      // Choose any of these options for coloring the tab red: "home", "pizza", "puff", "lunch", "aptz", "pasta", "salad", "promo", "bev", "icc"
      // $active = "aptz";
      include "php/nav.php";
    ?>
    <!-- End of Navigation -->
    <div class="block-center">
      <div class="grid">
        <!-- start of loop -->
        <?php
            $sql = "SELECT shop_items.item_id, shop_items.item_name, shop_items.item_img, shop_items.item_price, shop_items.item_category FROM shop_items WHERE shop_items.item_category = $category;"; // Query to MySQL
            $result = $conn->query($sql); // Save the result from the request to a variable
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="item">
          <a class="item-id" data-name="<?= htmlspecialchars($row["item_id"]) ?>" href="item.php?category=<?=$categoryStr?>&item-id=<?= $row["item_id"] ?>" onclick="goToCategory('<?= $categoryStr ?>'); document.location.reload(true)">
            <img
              src="<?php echo $row["item_img"] ?>"
              width="300"
              height="300"
              alt=""
            />
          </a>
          <h1 class="capitalize"><?php echo $row["item_name"] ?></h1>
          <div class="cart">
            <button onclick="location.href='item.php?item-id=<?= $row["item_id"] ?>'; goToCategory('<?= $categoryStr ?>');" data-id="<?= htmlspecialchars($row["item_id"]) ?>">
              <h2><?php echo $row["item_price"]?> USD</h2>
              <div>
                <img src="images/shopping-cart.png" alt="" />
              </div>
            </button>
          </div>
        </div>
        <!-- Close PHP loop -->
        <?php } ?>
      </div>
    </div>

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