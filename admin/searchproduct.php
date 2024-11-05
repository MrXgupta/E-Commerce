<?php
include("dao.php");
$query = $_POST['x'] ?? '';

// 
// $res = mysqli_query($con, $sql);
// while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
//     ;
?>
<table cellspacing="0" cellpadding="10" border="5">
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
        $sql = "SELECT * from products where name LIKE '%$query%' or id LIKE '%$query%' or description LIKE '%$query%'";
        $result = query($sql);
        if (mysqli_num_rows( $result ) > 0) {
        while ($userInfo = mysqli_fetch_array($result, MYSQLI_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($userInfo['id'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['name'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['description'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['price'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['stock'] ?? 'N/A'); ?></td>
                <td><img src="<?php echo htmlspecialchars($userInfo['images'] ?? 'N/A'); ?>" alt=""></td>
                <!-- <td><?php echo htmlspecialchars($userInfo['images'] ?? 'N/A'); ?></td> -->
                <td><?php echo htmlspecialchars($userInfo['sold'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($userInfo['category_name'] ?? 'N/A'); ?></td>
                <td><a href="update_product.php?id=<?php echo $userInfo['id']; ?>">Edit</a></td>
                <td><a href="delete_product.php?id=<?php echo $userInfo['id']; ?>" onclick="confirmdelete(event)">Delete</a>
                </td>

            </tr>
        <?php endwhile; }
        else {
            echo '<p class="warning">No product Found </p>';
        } ?>
    </table>


