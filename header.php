<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-COMMERCE DICS PROJECT</title>
    <link rel="stylesheet" href="style.css">
    <!-- <script src="https://kit.fontawesome.com/019376af01.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="/alok/dics project/font/css/fontawesome.min.css">
    <link rel="stylesheet" href="/alok/dics project/font/css/all.min.css">
    <script src="/alok/dics project/js/script.js"></script>
    

</head>

<body>
    <nav>
        <div>
            <a href="/alok/dics project/index.php">Home</a>
            <a href="/alok/dics project/pages/explore.php">Explore</a>
            <a href="/alok/dics project/pages/shop_by_category.php">Shop By Category</a>
            <a href="/alok/dics project/about.php">About</a>
        </div>
        <div>
            <i class="fa-solid fa-magnifying-glass searchBtn" onclick="searchProducts()"></i>
            <a href="/dics project/cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="/alok/dics project/credentials/signup.php"><i class="fa-solid fa-user"></i></a>
        </div>
    </nav>
    <div class="search">
        <input type="search" name="search" id="search" class="searchproducts" placeholder="Search Item Here"
            onkeyup="searchuserproduct()">


    </div>
    <div class="searchResult"></div>