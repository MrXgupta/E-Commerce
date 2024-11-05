
<?php



function getConnection(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "dics";
    $conn = mysqli_connect($host, $username, $password, $db);
    if (!$conn) {   
        die("Unable to Connect to Database an Unknow Error Occured".mysqli_connect_error());
    }
    return $conn;
}
function retrive_product($sql)  {
    $con = getConnection();
    $result = mysqli_query($con, $sql);
    // echo $row['name'];
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            echo "<div class='product'>";
            echo "<div class='product_img'>";
            echo "<img src='/alok/dics project/uploaded_images/". $row["images"]."' alt='".$row['images']."' onerror='showError(this)'>";
            echo "<div class='overlay'>Image Not Found</div>";
            echo "</div>";
            echo "<div class='product_info'>";
            echo "<h2>".$row['name']."</h2>";
            echo "<p>".$row['description']."</hp>";
            echo "<p> Price : <span>$".$row['price']." </span></p>";
            echo "<p> Category : <span>".$row["category_name"]."</span></p>";
            echo '<a href="product_info.php?id='.$row['id'].'"> Buy Now </a>';
            echo '<a onclick="add_to_cart()"> Add To Cart </a>';
            echo "</div>";
            echo "</div>";
        }
    }
}

function retrive_product3() {
    $con = getConnection();
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($con,$sql);
    if($result) {
        while($row = mysqli_fetch_array($result)) {
            echo "<div class='heading'>".$row['category_name']."</div>";
            echo "<div class=' cate ".$row['category_name']."'>";
            $id = $row['id'];
            $sql = "SELECT c.category_name, p.* FROM PRODUCTS p inner join categories c on p.category_id = c.id WHERE category_id = $id";
            retrive_product($sql);
            echo "</div>";
        }
    } 
}

function fetch_categories() {
    $con = getConnection();
    $sql = "SELECT id , category_name from categories";
    $result = mysqli_query($con,$sql);
    if($result) {
        echo "<div class='category_box'>";
    while($row = mysqli_fetch_array($result)) {
        echo "<a href='pages/categories.php?id=".$row['id']."&name=".$row['category_name']."'>".$row["category_name"]."</a>";
    }
    echo "</div>";
    }
}

function random_products() {
    $con = getConnection();
    $sql = "SELECT c.category_name, p.* FROM PRODUCTS p inner join categories c on p.category_id = c.id";
    
    $result = mysqli_query($con, $sql);
    $shuffle =[]; 
    // echo $row['name'];
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $shuffle[] = $row;
        }
        shuffle( $shuffle );
        foreach($shuffle as $row) {
            echo "<div class='product'>";
            echo "<div class='product_img'>";
            echo "<img src='/alok/dics project/uploaded_images/". $row["images"]."' alt='".$row['images']."' onerror='showError(this)'>";
            echo "<div class='overlay'>Image Not Found</div>";
            echo "</div>";
            echo "<div class='product_info'>";
            echo "<span class='id'>".$row['id']."</span>";
            echo "<h2>".$row['name']."</h2>";
            echo "<p>".$row['description']."</hp>";
            echo "<p> Price : <span>$".$row['price']." </span></p>";
            echo "<p> Category : <span>".$row["category_name"]."</span></p>";
            echo '<a href="/alok/dics project/pages/product_info.php?id='.$row['id'].'"> Buy Now </a>';
            echo '<a onclick="add_to_cart(this)"> Add To Cart </a>';
            echo "</div>";
            echo "</div>";
        }
    }}

?>