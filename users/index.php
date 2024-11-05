<?php include("header.php") ?>
<?php include("../config/dao.php") ?>
<?php  
    if (isset($_SESSION['username'])) {
        echo '<div class="welcome">Welcome, ' . $_SESSION['username']."</div>";
    } else {
        echo 'Please log in.';
    }
    ?>
<div class="msg"></div>

<div class="random">
    <?php random_products(); ?>
</div>
<?php include('../pages/cart.php'); ?>



<?php include("../footer.php") ?>
<?php  

    ?>