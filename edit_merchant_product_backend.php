<?php
require("connection.php");
$update_successfully = false;
$not_update_successfully = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pid = $_GET["pid"];
    $pname = $_POST["p_name"];
    $pprice = $_POST["p_price"];
    $ppsize = $_POST["p_size"];
    $pcolor = $_POST["p_color"];
    $pdescription = $_POST["p_description"];
    $pspecification = $_POST["p_specification"];
    $sql = "UPDATE `product` SET `product_name` = '$pname', `product_price` = '$pprice', `product_color` = '$pcolor', `product_size` = '$ppsize', `product_description` = '$pdescription', `product_specification` = '$pspecification' WHERE `product_id` = '$pid'";
    $result = mysqli_query($conn, $sql);





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
                    $insertValuesSQL .= "('".$fileName."', NOW(), '$pid'),"; 
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
            $delete = $conn->query("DELETE FROM images WHERE product_id='$pid'"); 
            $insert = $conn->query("INSERT INTO images (file_name, uploaded_on, product_id) VALUES $insertValuesSQL"); 
            if($delete && $insert && $result){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                // $statusMsg = "Files are uploaded successfully.".$errorMsg; 
                $update_successfully = true;
                header("location:merchant_index.php?update_successfully=$update_successfully");

            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
                echo mysqli_error($conn);
            } 
        } 
    }else{ 
        // $statusMsg = 'Please select a file to upload.';
        $not_update_successfully = true;
        header("location:merchant_index.php?not_update_successfully=$not_update_successfully");
    } 
     
    // Display status message 
    // echo $statusMsg; 

}





?>