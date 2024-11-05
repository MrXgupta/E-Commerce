<?php
include('../config/dao.php');
session_start();


if(isset($_SESSION['username'])) {
    $con = getConnection();
    $username = $_SESSION['username'];
    $sql = "SELECT userid from users where username = '$username'";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($res);
    $userid = $row['userid'];
    $id = $_POST['x'];
    $sql2 = "INSERT INTO CART(productid,userid) values($id,$userid)";
    $res2 = mysqli_query($con,$sql2);
    if($res2) {
        echo "<p class='success'> Added to Cart. </p>";
    }
    else {
        echo '<p class="warning"> Failed to Add to Cart. </p>';
    }
    

}
else {
    echo '<p class="warning"> Please log in. </p>';
}

?>