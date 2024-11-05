<?php include("../header.php"); 
include("../config/dao.php");
?>

<div class="random">
    <?php
    $id = $_GET["id"];
    $name = $_GET["name"];
    echo "<div class='heading'>".$name."</div>";
    $sql = "SELECT * FROM PRODUCTS WHERE category_id = $id";
    $sql = "SELECT c.category_name , p.* from categories c inner join products p on p.category_id = c.id where p.category_id = $id";
    retrive_product($sql);
    echo "<script> chkProducts(); </script>"
?>
</div>


<?php include('../footer.php'); ?>