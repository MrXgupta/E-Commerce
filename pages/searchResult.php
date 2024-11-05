<?php
include("../config/dao.php");
$con = getConnection();

$query = $_POST['x'];
$keywords = explode(' ', $query);
// echo $query;
$sql = "SELECT c.category_name, p.* FROM PRODUCTS p inner join categories c on p.category_id = c.id WHERE ";
$condition = [];
foreach($keywords as $word) {
    $word = mysqli_real_escape_string($con, $word);
    $condition[] = "(c.category_name LIKE '%$word%' or p.name like '%$word%' or p.description like '%$word%')";
}
$sql.= implode(" AND ", $condition);

$result = mysqli_query($con, $sql);

if(!$result) {
    die("SQL Error". mysqli_error($con));
}
// echo $row['name'];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='product'>";
        echo "<div class='product_img'>";
        echo "<img src='/alok/dics project/uploaded_images/" . $row["images"] . "' alt='" . $row['images'] . "' onerror='showError(this)'>";
        echo "<div class='overlay'>Image Not Found</div>";
        echo "</div>";
        echo "<div class='product_info'>";
        echo "<h2>" . $row['name'] . "</h2>";
        echo "<p>" . $row['description'] . "</hp>";
        echo "<p> Price : <span>" . $row['price'] . "rs </span></p>";
        echo "<p> Category : <span>" . $row["category_name"] . "</span></p>";
        echo '<a href="product_info.php?id=' . $row['id'] . '"> Buy Now </a>';
        echo '<a href="product_info.php?id=' . $row['id'] . '"> Add To Cart </a>';
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p class='warning'> No Product Found</p>";
}



?>