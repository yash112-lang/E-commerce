<?php
$contact_not_login = false;
require("connection.php");
session_start();
if(isset($_SESSION['loggedin']))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_SESSION['name'];
        $cname = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $sql = "INSERT INTO contact(oname, cname, email, subject, message) VALUES('$name', '$cname', '$email', '$subject', '$message')";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            header("location:index.php");
        }
        else
        {
           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Error!</strong> There was an error while submitting your form.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
        }
    }
}
else
{
    $contact_not_login = true;
    header("location:user_login.php?contact_not_login=$contact_not_login");
}

?>
