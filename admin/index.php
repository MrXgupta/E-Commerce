<?php
include("../header.php");
include("dao.php");
?>
<?php session_start(); ?>


<?php
if (isset($_SESSION['username'])) {
    echo '<div class="welcome" >Welcome, ' . $_SESSION['username'] . "</div>";
} else {
    header("location:../index.php");
}

if (isset($_SESSION["product_updated"])) {
    echo "<div class='success msg'> Product " . $_SESSION['product_updated'] . " Updated</div>";
    echo "<script> msg() </script>";
    unset($_SESSION["product_updated"]);
}

if (isset($_SESSION["id"])) {
    echo "<div class='success msg'>Product Deleted Successfully</div>";
    echo "<script> msg() </script>";
    unset($_SESSION["id"]);
}


?>



<button class="user_data_btn" onclick="userbtn()">User data</button>
<button class="product_data_btn" onclick="productbtn()">Product Data</button>
<button class="add_product" onclick="addProductbtn()">Add a New product</button>

<div class="add_new_product">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Name :</label>
        <input type="text" name="productName" id="name">
        <label for="desc">Description :</label>
        <input type="text" name="desc" id="desc">
        <label for="price">Price :</label>
        <input type="number" name="price" id="price" maxlength="5">
        <label for="stock">Stock :</label>
        <input type="number" name="stock" id="stock" maxlength="4">
        <label for="sold">Sold :</label>
        <input type="number" name="sold" id="sold" maxlength="4">
        <label for="images">Select Images :</label>
        <input type="file" name="images" id="images" accept="image/*">

        <select name="category" id="category">
            <?php
            $sql2 = "SELECT id, category_name from categories";
            $result2 = query($sql2);
            while ($row2 = mysqli_fetch_array($result2)) {
                echo $row2['category_name'];
                echo '<option value="' . htmlspecialchars($row2['id']) . '">' . htmlspecialchars($row2['category_name']) . '</option>';
            }
            ?>
        </select>
        <button type="submit">Add Product</button>



        <?php
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            add_new_product();
        }
        ?>

    </form>
</div>


<div class="user_data">
    <h2>User Data</h2>
    <input type="search" name="searchuser" id="searchuser" class="searchbar" onkeyup="searchuser()" placeholder="Search User data...">
    <!-- <div class="userResult"></div> -->
    <script>
       
    </script>
    <table class="userResult" cellspacing="0" cellpadding="10" border="5">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th>IP Address</th>
            <th>Geolocation</th>
        </tr>
        <?php
        $sql = 'SELECT * FROM users';
        $result = query($sql);
        while ($userInfo = mysqli_fetch_array($result, MYSQLI_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($userInfo['userid'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['username'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['name'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['dob'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['email'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['phone'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['password'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['datecreated'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['datemodified'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['ipaddress'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['geolocation'] ?? 'N/A'); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>



<div class="product_data">
    <h2>Product Data </h2>
    <input type="search" name="productsearch" id="productsearch" class="searchbar" onkeyup="searchproduct()" placeholder="Search Products...">
    <script>
        
    </script>
    <?php
    $sql = 'SELECT COUNT(*) as TOTAL from products';
    $result = query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $total = $row['TOTAL'];
    echo "<p class='total'> Total Products : " . $total . "</p>";
    ?>
    <select name="filter_products" id="filterProducts">
        <option value="">Sort By</option>
        <option value="Id">By ID</option>
        <option value="Id">By Categories</option>
        <option value="Id">By Price</option>
        <option value="Id">By Stock</option>
        <option value="Id">By Sold</option>
    </select>


    <table class="productResult" cellspacing="0" cellpadding="10" border="5">
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Images</th>
            <th>Sold</th>
            <th>Category Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        // $sql = 'SELECT * FROM products';
        $sql = 'SELECT c.category_name, p.* from products p INNER JOIN categories c ON p.category_id = c.id ORDER BY p.id';
        $result = query($sql);
        while ($userInfo = mysqli_fetch_array($result, MYSQLI_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($userInfo['id'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['name'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['description'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['price'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['stock'] ?? 'N/A'); ?></td>
                <td><img src="<?php echo htmlspecialchars($userInfo['images'] ?? 'N/A'); ?>" alt=""></td>
                <td><?php echo htmlspecialchars($userInfo['sold'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['category_name'] ?? 'N/A'); ?></td>
                <td><a href="update_product.php?id=<?php echo $userInfo['id']; ?>">Edit</a></td>
                <td><a href="delete_product.php?id=<?php echo $userInfo['id']; ?>" onclick="confirmdelete(event)">Delete</a>
                </td>

            </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include("../footer.php"); ?>
