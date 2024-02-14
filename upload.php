<?php
if (isset($_POST["submit"])) {
    $target_dir = "C:/xampp1/htdocs/main prjt/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
      
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           
            $image_name = $_FILES["fileToUpload"]["name"];
            $image_path = $target_file;

            
            $conn = new mysqli("localhost", "root", "", "msm");

            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $sql = "INSERT INTO image_gallery (image_name, image_path) VALUES ('$image_name', '$image_path')";

         
            if ($conn->query($sql) === TRUE) {
                echo "Image uploaded successfully and added to the database.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

          
            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>
