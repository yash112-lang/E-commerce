<?php

require("connection.php");
$loggedin = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user_register(name, email, password) VALuES('$name', '$email', '$password_hash')";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $row['email'];
        $_SESSION['loggedin'] = true;
        header("location:index.php");
    }
    else
    {
        echo "There was an error<br>" . mysqli_error($conn);
    }
}


?>