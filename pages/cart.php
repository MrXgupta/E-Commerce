<div class="cart">
    <h1 class="heading">Your Cart <i class="fa-solid fa-cart-shopping"> </i></h1>
    <div class="cart_cont">
        <?php
        $con = getConnection();
        $username = $_SESSION['username'];
        $sql = "SELECT userid from users where username = '$username'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        $userid = $row['userid'];


        $sql2 = "SELECT * FROM cart WHERE userid = $userid";
        $res2 = mysqli_query($con, $sql2);
        while ($row = mysqli_fetch_array($res2)) {
            $id = $row['productid'];
            $q = 5;
            $sql3 = "SELECT c.category_name, p.* FROM products p inner join categories c on p.category_id = c.id where p.id = $id";
            $con = getConnection();
            $result = mysqli_query($con, $sql3);
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
                    echo "<p> Price : <span>$" . $row['price'] . " </span></p>";
                    echo "<p> Category : <span>" . $row["category_name"] . "</span></p>";
                    echo "<p> Quantity : <select name='' id=''>".
                    $selected = ($q == $q) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($q) . '" ' . $selected . '>' . htmlspecialchars($q) . '</option>'
                        ."
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        </select></p>";
                    echo '<a href="product_info.php?id=' . $row['id'] . '"> Buy Now </a>';
                    echo '<a onclick="add_to_cart()"> Add To Cart </a>';
                    echo "</div>";
                    echo "</div>";
                }
            }
            // echo $q;
        
            // $res = mysqli_query($con,$sql3);
            // $product = mysqli_fetch_array($res);
            // print_r($product);
        }


        ?>

    </div>
</div>