<?php include("../header.php"); ?>
<?php include("../config/dao.php"); ?>
<div>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" placeholder="Enter your Username" onkeyup="chkusername()">
        <div class="username-info">
            <p>Enter a Unique Username</p>
        </div>

        <label for="name">Full Name :</label>
        <input type="text" name="name" id="name" class="capital" placeholder="Enter your Name">

        <label for="dob">DOB :</label>
        <input type="text" name="dob" id="dob" placeholder="Enter your DOB" onfocus="(this.type='date')" onblur="(this.type='text')">

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" placeholder="Enter your Email">

        <label for="phone">Phone Number :</label>
        <input type="number" name="phone" id="phone" placeholder="Enter your Phone Number">

        <label for="pswrd">Set Password :</label>
        <input type="text" name="pswrd" id="pswrd" placeholder="Enter your Password">
        <div class="pass-info">
        <p>Password must be at least 8 characters long, <br> contain at least one uppercase letter, <br> one lowercase letter, <br> one number, <br>and one special character. </p>
        </div>

        <label for="pswrd2">Enter Your Password Again :</label>
        <input type="text" name="pswrd2" id="pswrd2" placeholder="Enter your Password Again">

        <button type="submit">Signup Now</button>
        <span>Already have an Account? <a href="/alok/dics project/credentials/login.php">LogIn Now</a></span>
    </form>
</div>


<script>
    let username = document.querySelector('.username-info');
    let usernameInput = document.querySelector('#username');

    let pass = document.querySelector('.pass-info');
    let passInput = document.querySelector('#pswrd');

    // for username
    usernameInput.addEventListener('focus',()=> {
        username.classList.toggle('show_p');
    })
    // for pswrd
    passInput.addEventListener('focus',()=> {
        pass.classList.toggle('show_p');
    })

    function chkusername() {
    let x = document.querySelector('#username').value;
    let res = document.querySelector('.username-info');
    let ajax = new XMLHttpRequest();
    
    ajax.open('POST', 'chkusername.php', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            res.innerHTML = ajax.responseText;
        }
    };
    
    ajax.send('x=' + encodeURIComponent(x)); // Properly encode the data
}

  
    
</script>

<?php 
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = getConnection();
    // Sanitize and validate input
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $dob = trim($_POST['dob']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $pass = trim($_POST['pswrd']);
    $passcheck = trim($_POST['pswrd2']);

    $errors = [];

    if($pass !== $passcheck) {
        $errors[] = 'Password Does not matched.';
    }
    
    // Validate required fields
    if (empty($username) || empty($name) || empty($dob) || empty($email) || empty($phone) || empty($pass) || empty($passcheck)) {
        $errors[] = "Fill out all the fields.";
    }

    // check if username already exists or not
    $chk = "SELECT * FROM users where username = '$username'";
    $res = mysqli_query($con,$chk);
    if(mysqli_num_rows($res) > 0) {
        $error[] = "Username Already Exists Please Try Another One";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate phone number (only numbers, 10-15 digits)
    if (!preg_match('/^\d{10,15}$/', $phone)) {
        $errors[] = "Phone number must be 10 to 15 digits long.";
    }

    // Validate password strength
    if (strlen($pass) < 8 || !preg_match('/[A-Z]/', $pass) || !preg_match('/[a-z]/', $pass) || 
        !preg_match('/[0-9]/', $pass) || !preg_match('/[\W]/', $pass)) {
        $errors[] = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }



    // Check for errors before inserting into the database
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p class='warning'>{$error}</p>";
        }
    } else {
        // Hash the password
        $hashedPassword = md5($pass);
        
        // Prepare the SQL statement to prevent SQL injection
        $sql = "INSERT INTO users (username, name, dob, email, phone, password) VALUES ('$username', '$name', '$dob', '$email', '$phone', '$hashedPassword')";
        $result = mysqli_query($con, $sql);
        if(!$result) {
            echo "Unable to add Data";
        }

        echo "<p class='success'>Successfully Registered</p>";
        

        
    }

    // Close the database connection
    $con->close();
}


// function chkusername() {
//     $username = $_POST["username"];
//     $con = getConnection();
//     $chkusername = "SELECT * FROM users WHERE username = '$username'";
//     $checkedusername = mysqli_query($con,$chkusername);
//     if (mysqli_num_rows($checkedusername) > 0) {
//         $errors[] = "Username already taken";
//     }
// }
// 
?>
<?php include("../footer.php"); ?>