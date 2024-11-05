<?php

function getConnection() {
    $con = mysqli_connect('localhost','root','','dics');
    if (mysqli_connect_errno()) {   
        echo 'Error'. mysqli_connect_error();
        exit(); 
    }
    return $con;
}

function query($sql) {
    $con = getConnection();
    $result = mysqli_query($con, $sql);
    return $result;
}

function add_new_product() {
    $name = $_POST['productName'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $sold = $_POST['sold'];
    $categoryid = $_POST['category'];
    $images = '';
    if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['images']['tmp_name'];
        $fileName = $_FILES['images']['name'];
        $fileSize = $_FILES['images']['size'];
        $fileType = $_FILES['images']['type'];
        
        // Define the upload directory
        $uploadFileDir = '../uploaded_images/'; // Ensure this directory exists and is writable
        $dest_path = $uploadFileDir . $fileName;

        // Move the file from the temporary directory to the destination
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $images = $dest_path; // Store the path for database insertion
        } else {
            echo "<p class='warning'>Error moving the uploaded file.</p>";
            return; // Stop execution if the file cannot be moved
        }
    } else {
        echo "<p class='warning'>File upload error.</p>";
        return; // Stop execution if there's an error
    }
    
    
    $sql = "INSERT INTO products(name,description,price,stock,sold,images,category_id) values('$name', '$desc', $price, $stock, $sold, '$images', $categoryid)";
    $result = query($sql);
    if($result) {
        echo "<p class='success msg'> SuccessFully Added </p>";
        echo "<script> msg() </script>";
    } else {
        echo "<p class='warning'> Unable to Add Data </p>";
    }
}

function update_product() {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $sold = $_POST['sold'];
    $categoryid = $_POST['category'];
    
    $images = '';
    if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['images']['tmp_name'];
        $fileName = $_FILES['images']['name'];
        $fileSize = $_FILES['images']['size'];
        $fileType = $_FILES['images']['type'];
        
        // Define the upload directory
        $uploadFileDir = '../uploaded_images/'; // Ensure this directory exists and is writable
        $dest_path = $uploadFileDir . $fileName;

        // Move the file from the temporary directory to the destination
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $images = $dest_path; // Store the path for database insertion
        } else {
            echo "<p class='warning'>Error moving the uploaded file.</p>";
            return; // Stop execution if the file cannot be moved
        }
    }
        $sql = "UPDATE products SET name = '$name', description = '$desc', price = $price, stock = $stock, images = '$images', sold = $sold, category_id = '$categoryid' WHERE id = $id";
        $result = query($sql);
        
        if ($result) {
            $_SESSION["product_updated"] = $name;
            header("location:index.php");
            exit();
            
    } else {
        echo "<p class='warning'> Unable to Update Product </p>";
    }
}



?>