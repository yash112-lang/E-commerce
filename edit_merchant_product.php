<?php
require("connection.php");
echo '<center><h2>This service is not available</h2></center>';
$pid=$_GET['pid'];
$sql = "SELECT * FROM PRODUCT WHERE product_id='$pid'";
$result = mysqli_query($conn, $sql);
if($result)
{
    if(mysqli_num_rows($result)>=1)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $pname = $row['product_name'];
            $pprice = $row['product_price'];
            $pcolor = $row['product_color'];
            $psize = $row['product_size'];
            $pdescription = $row['product_description'];
            $pspecification = $row['product_specification'];
            $pdate = $row['date'];
        }
        echo '<!doctype html>
        <html lang="en">
          <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        
            <title>Hello, world!</title>
          </head>
          <body>
              <?php
        
                require("merchant_navbar.php");
            ?>
            <div class="container mt-4">
            
          <form class="form" id="form" action="edit_merchant_product_backend.php?pid='.$pid.'" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="pname">Product Name</label>
            <input type="text" class="form-control" id="pname" value="'. $pname .'" name="p_name" placeholder="Enter your product name here.">
          </div>
          <div class="form-group">
            <label for="pprice">Price Of Product</label>
            <input type="text" class="form-control" id="pprice" value="'. $pprice .'" name="p_price" placeholder="Enter Price of product.">
          </div>
          <div class="form-group">
            <label for="psize">Size Of Product</label>
            <input type="text" class="form-control" id="psize" name="p_size" value="'. $psize .'" placeholder="Enter size of product.">
          </div>
          <div class="form-group">
            <label for="pcolor">Color Of Product</label>
            <input type="text" class="form-control" id="pcolor" name="p_color" value="'. $pcolor .'" placeholder="Enter color product.">
          </div>
          
          
          
          <div class="form-group">
            <label for="word_count">Description</label>
            <textarea class="form-control word_count" id="word_count" name="p_description" rows="3">'.$pdescription.'</textarea>
          </div>
          <div class="form-group">
            <label for="word_count">Specifications</label>
            <textarea class="form-control" id="word_count" name="p_specification" rows="3">'. $pspecification .'</textarea>
          </div>
                  <!-- <div class="form-group">
                    <label for="exampleFormControlInput1">Images Of Product</label>
                    <input type="file" class="ml-4" id="exampleFormControlInput1">
                  </div> -->
            <label for="exampleFormControlTextarea1">Select New Image Files to Upload:</label>
                  
            <input id="pimage" class="ml-4 mb-4" type="file" name="files[]" multiple > <span id="pimage_change"></span>
                  <center>
                    <button class="btn btn-primary mb-4" type="button" onclick="validation()">Submit</button>
                  </center>
        </form>
        </div>
        <script>
            var countre = /[\w\u2019\x27\-]+/g,
            cleanre = /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g;
         
        function wordCount(tx)
        {
            var tc = 0;
         
            if (tx) {
                tx = tx.replace(/\.\.\./g, " "); // convert ellipses to spaces
                tx = tx.replace(/<.[^<>]*?>/g, " ").replace(/&nbsp;|&#160;/gi, " "); // remove html tags and space chars
         
                // deal with html entities
                tx = tx.replace(/(\w+)(&.+?;)+(\w+)/, "$1$3").replace(/&.+?;/g, " ");
                tx = tx.replace(cleanre, ""); // remove numbers and punctuation
         
                var wordArray = tx.match(countre);
                if (wordArray) {
                    tc = wordArray.length;
                }
            }
         
            return tc;
        }
        jQuery(function ($) {
            var $counterText = $(`<div class="word-counter" />`);
         
            // Get the textarea field
            $(".word_count")
         
            // Add the counter after it
            .after($counterText)
            
            // Bind the counter function on keyup and blur events
            .bind("keyup blur", function () {
                // Count the words
                var val = $(this).val(),
                count = wordCount(val);
         
                // Set the counter text
                $counterText.text(count + "/400 words");
            })
            
            // Trigger the counter on first load
            .keyup();
        });
        function validation()
        {
          a = false;
        if(pname.value == "")
        {
          pname.style="border-color: red"
        }
        else if(pprice.value == "")
        {
          pprice.style="border-color: red"
        }
        else if(psize.value == "")
        {
          psize.style="border-color: red"
        }
        else if(pcolor.value == "")
        {
          pcolor.style="border-color: red"
        }
        else if(pimage.value == "")
        {
          pimage_change.innerHTML="***Please Choose Valid file***";
          pimage_change.style="Color: Red";
          pimage_check = true
        }
        else
          {
            form.submit();
          }
        }
        
        
        
        
        
        
        
        
        
        </script>
        
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
          </body>
        </html>';
    }
}


?>