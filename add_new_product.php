<?php

require("connection.php");
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
    session_start();
    $product_name = $_POST['p_name'];
    $product_price = $_POST['p_price'];
    $product_size = $_POST['p_size'];
    $product_color = $_POST['p_color'];
    $product_description = $_POST['p_description'];
    $product_specification = $_POST['p_specification'];
    $product_id = randomPassword();
    $shop_id = $_SESSION['sid'];
    $targetDir = "product_images/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', NOW(), '$product_id'),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $conn->query("INSERT INTO images (file_name, uploaded_on, product_id) VALUES $insertValuesSQL"); 
            $sql = "INSERT INTO product(product_id, product_name, product_price, product_color, product_size, product_description, product_specification, shop_id) VALUES('$product_id', '$product_name', '$product_price', '$product_color', '$product_size', '$product_description', '$product_specification','$shop_id')";
            $result = mysqli_query($conn, $sql);
            if($insert && $result){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                // $statusMsg = "Files are uploaded successfully.".$errorMsg;
                header("location:merchant_index.php");
                // echo $product_id;
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
     
    // Display status message 
    // echo $statusMsg;
}

?>