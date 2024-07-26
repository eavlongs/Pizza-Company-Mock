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
<title>Pizza Company - Outlet</title>
    <?php
      include "php/head.php";
    ?>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php
        $category = "notCate";
      include "php/nav.php";
    ?>
<!--Outlet-->

<div class="outlet-box" style="border: 0.12px solid transparent;">
   <h3> Outlets</h3>
  </div>
<!--eaon-->
<div class="outlet-eaon" style="border: 0.12px solid transparent;">

    <ul class="li-headline">
       <hr>

       <?php
            $mysql = "SELECT * FROM shop_location;";
            $result = $conn->query($mysql);
            while ($row = mysqli_fetch_assoc($result)){

       ?>
        <li><img src="<?= $row['img'] ?>" ALIGN="left">
            <h3 >&nbsp;<?= $row['name'] ?></h3>
            <h5 style="color: grey;">&nbsp;<?= $row['specifics'] ?><br><br><br><br><br></h5>
        </li>

        <?php } ?>

    </ul>



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
