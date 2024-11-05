<?php include("../header.php"); ?>
<?php include("../config/dao.php"); ?>
<?php session_start(); ?>


<div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" placeholder="Enter your Username">
        
        <label for="pswrd">Password :</label>
        <input type="text" name="pswrd" id="pswrd" placeholder="Enter your Password">
        <!-- <button class="otp">Send OTP</button> <br> -->
        <!-- <label for="otp">Enter Your OTP</label>
        <input type="number" name="otp" id="otp" maxlength="4" placeholder="Enter Your Otp Here"> -->
        <button type="submit" name="login">Log In Now</button>
        <span>New Here? <a href="/alok/dics project/credentials/signup.php">SignUp Now</a></span>
    </form>
    
</div>

<?php





if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    unset($_SESSION['username']);
    $username = trim($_POST['username']);
    $pass = trim($_POST['pswrd']);
    $hashpass = md5($pass);
    $_SESSION['username'] = $username;


    if($username == 'admin' && md5($pass) == md5('admin')) {
        header('location:../admin/index.php');
    }

    if(isset($_SESSION['username'])) {
        echo '<p class="warning"> Already Logged in </p>';
    }

    if(empty($username) || empty($pass) ) { 
        echo '<p class="warning"> Fill Out All The Feilds </p>';
    exit;
    }

    $con = getConnection();

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashpass'";
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res) > 0) {
        header("location:../users/index.php");
        exit; 
    }
    else {
        echo "<p class='warning'> Username or Password is Invalid </p>";
    }
}

?>
<?php include("../footer.php"); ?>