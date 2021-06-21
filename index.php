<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="index_css.css">
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

  <title>Home</title>
</head>

<body>
  <?php
  require("connection.php");
    session_start();
    require("utilities/navbar.php");
  ?>

  <div class="search ml-4 mr-4 mt-2">
    <form class="search-form">
      <input type="text" placeholder="Search for books, authors, categories and more..">
      <input type="submit" value="Submit">
    </form>
  </div>


  <section class="text-gray-700 body-font">
  <div class="container px-4 py-24 mx-auto">
    <div class="flex flex-wrap -m-4">
    <?php


$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
  $pid = $row['product_id'];
  $s = "SELECT * FROM images where product_id='$pid'";
  $r = mysqli_query($conn, $s);
  $q = mysqli_fetch_assoc($r);
  $a = $q["file_name"];
  echo '
      
      <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
        <a class="block relative h-48 rounded overflow-hidden" href=show_card.php?pid='. $row["product_id"] .'>
          <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="product_images/'. $a .'">
        </a>
        <div class="mt-4">
          
          <a href=show_card.php?pid='. $row["product_id"] .' style="text-decoration: none;"><h2 class="text-gray-900 title-font text-lg font-medium">'. $row["product_name"] .'</h2></a>
          <p class="mt-1">'. $row["product_price"] .'</p>
        </div>
      </div>
      
     
      ';
    }
    
    ?>
    
    </div>
  </div>
</section>
      
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>