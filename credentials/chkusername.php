<?php
include("../config/dao.php");
$username = $_POST['x']??'';

$con = getConnection();
$sql = "SELECT * FROM USERS WHERE username = '$username'";
$res = mysqli_query($con,$sql);

if(mysqli_num_rows($res)> 0){
    echo "<p class='warning' >Username already Taken </p>";
}else{
    echo "<p class='success'>Username Available </p>";
}

?>