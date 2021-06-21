<?php
require("connection.php");
$connection_error = false;
function randomPassword() {
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 15; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $shop_name = $_POST['sname'];
  $scategory = $_POST['scategory'];
  $postal = $_POST['postal'];
  $phone = $_POST['phone'];
  $shop_id = randomPassword();
  $sql = "INSERT INTO merchant_register(name, email, password, phone, shop_name, shop_category, shop_id, postal) VALUES('$name', '$email', '$password', '$phone', '$shop_name', '$scategory', '$shop_id', '$postal')";
  $result = mysqli_query($conn, $sql);
  if($result)
  {
    session_start();
    $_SESSION['name'] = $name;
    $_SESSION['sname'] = $shop_name;
    $_SESSION['sid'] = $shop_id;
    $_SESSION['sloggedin'] = true;
        header("location:merchant_index.php");
    }
  
  else
  {
    $connection_error = true;
    header("location:merchant_register.php?connection_error=$connection_error");
  }
}


?>