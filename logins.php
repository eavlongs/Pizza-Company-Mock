<?php
$servername = "localhost"; //IP : 192.168.2.1 ; // cloud : gs.google.com.com.kh:887
$username = "root"; //admin : root ;
$password = "";
$dbname = "pizza";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);

}else{

}
$user = json_decode($_POST['userData'], true);

$sql1 = "SELECT customer_name, email, password FROM users";
$result = $conn->query($sql1);
$canLogin = false;
$username;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row['email'] == $user['email']) {
        if($row['password'] == $user['password']) {
            $canLogin = true;
            $username = $row['customer_name'];;
        }
    }
  }
} else {
  echo json_encode(array('success' => 0));
}

if($canLogin) {
  echo json_encode(array('success' => 1, 'username' => $username));
    // setcookie('current_user', $cookie_value, time() + (86400 * 30), "/");
}
else {
  echo json_encode(array('success' => 0));
}

$conn->close();
?>