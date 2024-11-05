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
        $sql = "SELECT * FROM users WHERE name LIKE '%$query%'";
        $result = query($sql);
        if ($result->num_rows > 0) {
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
        <?php endwhile; }
        else {
            echo '<p class="warning">No User Found </p>';
        } ?>
    </table>


