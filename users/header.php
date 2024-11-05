<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../font/css/fontawesome.min.css">
    <link rel="stylesheet" href="../font/css/all.min.css">
    <script src="/alok/dics project/js/script.js"></script>
    <?php session_start(); ?>
</head>
<body>
<nav>
        <div>
            <a href="/alok/dics project/users/index.php">Home</a>
            <a href="/alok/dics project/users/Shop.php">Shop</a>
            <a href="/alok/dics project/users/shop_by_category.php">Shop By Category</a>
            <a href="/alok/dics project/users/about.php">About</a>
        </div>
        <div>
            <i class="fa-solid fa-magnifying-glass searchBtn"></i>
            <i class="fa-solid fa-cart-shopping" onclick="cart()"></i>
            <a href="/alok/dics project/credentials/signup.php"><i class="fa-solid fa-user"></i></a>
        </div>
</nav>
</body>
</html>