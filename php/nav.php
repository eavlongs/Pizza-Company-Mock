<!-- <script>
  goToCategory('home');
</script> -->
<?php
  function getCategory() {
    if (isset($_GET["category"])) {
    return $_GET["category"];
    }
    return "home";
  }
  $category = getCategory();
  $categoryStr = $category;
  $arr = array("home", "pizza", "puff", "lunch", "aptz", "pasta", "salad", "promo", "bev", "icc", "others");
  $active = $category;
  for ($i = 0; $i < count($arr); $i++){
    $item = $arr[$i];
    if ($active == $item){
      $$item = ' style="background-color: #cc1e1e"';
      $category = $i+1;
    }
    else {
      $$item = "";
    }
  }

  if (gettype($category) == "string" || $category == 11){
    $category = 0;
  }


  echo '
  <div class="block-wide">
    <div class="header">
      <div class="topnav1">
        <a onclick="goToCategory(\'others\'); document.location.reload(true)" href="about_us.php?category=others"> About us</a>
        <a>|</a>
        <a onclick="goToCategory(\'others\'); document.location.reload(true)" href="contact_us.php?category=others">Contact us</a>
        <a>|</a>
        <a onclick="goToCategory(\'others\'); document.location.reload(true)" href="outlet.php?category=others">Outlets</a>
        <a>|</a>
      </div>
    </div>
  </div>
  <div class="block-wide">
    <div class="header">
      <img src="images/pizza-logo-home.png" />
      <img src="images/small_brand.jpg" />
    </div>
  </div>

  <div class="block-wide bg">
    <div class="block-center">
      <div class="topnav">
        <a onclick="goToCategory(\'home\'); document.location.reload(true);" href="index.php?category=home" class="cursor-pointer"'.$home.'>Home</a>
        <a onclick="goToCategory(\'pizza\'); document.location.reload(true);" href="index.php?category=pizza" class="cursor-pointer"'.$pizza.'>Pizza</a>
        <a onclick="goToCategory(\'puff\'); document.location.reload(true);" href="index.php?category=puff" class="cursor-pointer"'.$puff.'>Puff</a>
        <a onclick="goToCategory(\'lunch\'); document.location.reload(true);" href="index.php?category=lunch" class="cursor-pointer"'.$lunch.'>Lunch set</a>
        <a onclick="goToCategory(\'aptz\'); document.location.reload(true);" href="index.php?category=aptz" class="cursor-pointer"'.$aptz.'>Appetizers</a>
        <a onclick="goToCategory(\'pasta\'); document.location.reload(true);" href="index.php?category=pasta" class="cursor-pointer"'.$pasta.'>Pasta</a>
        <a onclick="goToCategory(\'salad\'); document.location.reload(true);" href="index.php?category=salad" class="cursor-pointer"'.$salad.'>Salad</a>
        <a onclick="goToCategory(\'promo\'); document.location.reload(true);" href="index.php?category=promo" class="cursor-pointer"'.$promo.'>Promotion</a>
        <a onclick="goToCategory(\'bev\'); document.location.reload(true);" href="index.php?category=bev" class="cursor-pointer"'.$bev.'>Beverage</a>
        <a onclick="goToCategory(\'icc\'); document.location.reload(true);" href="index.php?category=icc" class="cursor-pointer"'.$icc.'>Ice Cream Cake</a>
        <a href="cart.php" style="float: right; margin-right: 0; ">
          <img src="images/shopping-cart.png"/ width="20" height="15">
        </a>
        <a id="login" href="login.html" style="float: right; margin-right: 0; "
          >Log in
        </a>
        <a id="signout" href="index.php" onclick="signOut()" style="float: right; margin-right: 0;"
          >Sign out
        </a>
      </div>
    </div>
  </div>';
    // logged in or signed out status

    // $status = $_COOKIE["username"];
    (isset($_COOKIE["username"])) ? $loggedIn = TRUE : $loggedIn = FALSE;

    if ($loggedIn){
      echo '<script>displayNone("login")</script>';
    }
    else {
      echo '<script>displayNone("signout")</script>';
    }
?>