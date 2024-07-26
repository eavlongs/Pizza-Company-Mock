<?php
$servername = "localhost"; //IP : 192.168.2.1 ; // cloud : gs.google.com.com.kh:887
$username = "root"; //admin : root ;
$password = "";
$dbname = "pizza";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);

}else{

}
$user = json_decode($_POST['userData'], true);
$sql1 = "SELECT email FROM users";
$result = $conn->query($sql1);
$canCreate = true;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    if($row['email'] == $user['email']) {
      $canCreate = false;
    }
  }
} else {
  $canCreate = true;
}

if($canCreate) {
  $sql2 = "INSERT INTO users (customer_name, email, password, phone_number)
  VALUES ('". $user['name']. "', '". $user['email'] ."', '" . $user['password'] . "', '". $user['phone'] ."');";

  // if ($conn->query($sql2) === TRUE)
  if (mysqli_query($conn, $sql2)) {
    echo json_encode(array('success' => 1));
  } else {
    echo json_encode(array('success' => 0));
  }
}
else {
  echo json_encode(array('success' => 0));
}

$conn->close();
?>