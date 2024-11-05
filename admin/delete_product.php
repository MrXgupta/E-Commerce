<?php
include("dao.php");
include("../header.php");
$id = $_GET['id'];
echo $id;

$sql = "DELETE from products where id = $id";
$result = query($sql);
if($result) {
    session_start();
    $_SESSION["id"] = $id;
    header("location:index.php");
}
else {
    echo "<p class='warning'> Unable to Delete your Product </p>";
}


?>