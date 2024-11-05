<?php include('../config/dao.php');
include('../header.php');
?>

<div class="product_info_div">
    <?php
    $id = $_GET['id'];
    $sql = "SELECT c.category_name, p.* FROM PRODUCTS p inner join categories c on p.category_id = c.id WHERE p.id = $id";
    $con = getConnection();
    $res = mysqli_query($con,$sql);
    if($res) {
        $row = mysqli_fetch_array($res);
        echo "<div class='product_info_img'>";
        echo "<img src='".$row['images']."'>";
        echo "</div>";
        echo "<div class='product_info_2'>";
        echo "<h1>".$row['name']."</h1>";
        echo "<p>".$row['description']."</p>";
        echo "<h3>Price : $".$row['price']."</h3>";
        echo "<h3>Stock : ".$row['stock']."</h3>";
        echo "<p> ".$row['sold']." Sold till now";
        echo "<h3>Category : ".$row['category_name']."</h3>";
        echo '<a href="buy_now.php?id='.$row['id'].'"> Buy Now </a>';
        echo '<a onclick="add_to_cart_pi(this)"> Add To Cart </a>';
        echo "<span class='id'>".$row['id']."</span>";
        echo "</div>";

    }
    ?>  
</div>


<div class="warning msg"></div>
<h1 class="heading">More Suggestion</h1>
<div class="random">

    <?php
    random_products();
    ?>
    </div>




<?php include('../footer.php'); ?>
