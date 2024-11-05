<?php include("header.php"); ?>
<?php include("config/dao.php"); ?>
<?php
    session_start();
    unset($_SESSION['username']);
    ?>
<?php fetch_categories();
?>
<div class="msg" onload="msg()"></div>
<div class="random">
    <?php random_products(); ?>
</div>

<div class="page_scroll" onclick="pageScroll()"><i class="fa-solid fa-arrow-down"></i></div>








<?php include("footer.php"); ?>