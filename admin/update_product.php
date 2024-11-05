<?php
include("dao.php");
include("../header.php");
$id = $_GET['id'];
// echo $id;

$sql = "select * from products where id = '$id'";
$result = query($sql);
$row = mysqli_fetch_array($result);
session_start();
ob_start();
// $id = $row["id"];
// echo $name = $row['name'];
// echo $desc = $row['description'];
// echo $price = $row['price'];
// echo $stock = $row['stock'];
// echo $images = $row['images'];
// echo $sold = $row['sold'];
// echo $cate = $row['category_id'];


?>




<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <label for="name">Name :</label>
    <input type="text" name="name" id="name" value="<?php echo $name = $row['name']; ?> ">
    <label for="desc">Description :</label>
    <input type="text" name="desc" id="desc" value="<?php echo $desc = $row['description']; ?>">
    <label for="price">Price :</label>
    <input type="number" name="price" id="price" maxlength="5" value="<?php echo $price = $row['price']; ?>">
    <label for="stock">Stock :</label>
    <input type="number" name="stock" id="stock" maxlength="4" value="<?php echo $stock = $row['stock']; ?>">
    <label for="sold">Sold :</label>
    <input type="number" name="sold" id="sold" maxlength="4" value="<?php echo $sold = $row['sold']; ?>">
    <label for="images">Select Images :</label>
    <input type="file" name="images" id="images" accept="image/*" value="<?php echo $images = $row['images']?>">
    <label for="category">Category :</label>
    <select name="category" id="category" value>
        <!-- <?php
        $sql2 = "SELECT id, category_name from categories";
        $result2 = query($sql2);
        while ($row2 = mysqli_fetch_array($result2)) {
            echo $row2['category_name'];
            echo '<option value="' . htmlspecialchars($row2['id']) . '">' . htmlspecialchars($row2['category_name']) . '</option>';

        }
        ?> -->

        <?php
        $sql2 = "SELECT id, category_name FROM categories";
        $result2 = query($sql2);
        while ($row2 = mysqli_fetch_array($result2)) {
            $selected = ($row2['id'] == $row['category_id']) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($row2['id']) . '" ' . $selected . '>' . htmlspecialchars($row2['category_name']) . '</option>';
        }
        ?>
    </select>
    <button type="submit">Add Product</button>


    <?php

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        update_product();
    }

    ob_end_flush();

    ?>

</form>