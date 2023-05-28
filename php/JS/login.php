<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once("../Connections/Connection.php");
$con = connection();

//signup
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $access = $_POST['role']; 

    $errorUsername = '';
    $errorEmail = '';
    $errorPassword = '';
    $errorConfirm = '';
    

    $checkUsername = "SELECT * FROM users WHERE username='$username'";
    $result = $con->query($checkUsername);
    if ($result->num_rows > 0) {
        $errorUsername = "Username already exists!";
    }

    $checkPass = "SELECT * FROM users WHERE password='$password'";
    $result = $con->query($checkPass);
    if ($result->num_rows > 0) {
        $errorPassword = "Password already exists!";
    }

    $confirmPassword = $_POST['confirmPassword'];
    if ($password !== $confirmPassword) {
        $errorConfirm = "Passwords don't match!";
    }

    if (strlen($password) < 8) {
        $errorPassword = "Password must be 8 characters or more!";
    }

    $checkemail = "SELECT * FROM users WHERE email='$email'";
    $result = $con->query($checkemail);
    if ($result->num_rows > 0) {
        $errorEmail = "Email already exists!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorEmail = "Invalid email format!";
    }

    if (empty($errorUsername) && empty($errorPassword) && empty($errorConfirm) && empty($errorEmail)) {
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, password, role, email) VALUES ('$username', '$password', '$access', '$email')";
        $con->query($sql) or die($con->error);

        // Redirect to login form
        $successMessage = "Registration successful! Please sign in.";
        echo "<script>
            window.onload = function() {
                document.getElementById('sign-up-btn').click();
                document.getElementById('successMessage').innerText = '$successMessage';
            }
        </script>";

    }
}


//sign-up end


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $user = $con->query($sql) or die($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if ($total > 0) {
        $_SESSION["UserLogin"] = $row["username"];
        $_SESSION["Access"] = $row["access"];

        header("Location: userPage.php");
        exit;
    } else {
        $errorMessage = "Invalid username or password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

</head>
<body>
    
    <div class="container">
        <div class="signin-signup">

        <form id="registrationForm" class="sign-in-form" method="post">


              <input type="hidden" name="role" value="user">



            <div class="input-field">            
                 <i class="fas fa-user"></i>
                 <input type="text" placeholder="Username" id="userName" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"  required>
                 <i class="fas fa-exclamation-circle" style="color: red; display: <?php echo empty($errorUsername) ?  'none' : 'inline-block' ; ?>"></i>
            </div>            
            <div id="errUid" class="error"><?php echo isset($errorUsername) ? $errorUsername : ''; ?></div>
            <div class="input-field">            
              <i class="fas fa-envelope"></i>
              <input type="text" placeholder="Email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"  required>
              <i class="fas fa-exclamation-circle" style="color: red; display: <?php echo empty($errorEmail) ?  'none':'inline-block' ; ?>"></i>
            </div>
            <div id="errEmail" class="error"><?php echo isset($errorEmail) ? $errorEmail : ''; ?></div>
            <div class="input-field">            
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
              <i class="fas fa-exclamation-circle" style="color: red; display: <?php echo empty($errorPassword) ? 'none': 'inline-block' ; ?>"></i>
            </div>            
             <div id="errPassword" class="error"><?php echo isset($errorPassword) ? $errorPassword : ''; ?></div>
             <div class="input-field">             
                 <i class="fas fa-lock"></i>
                 <input type="password" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword" value="<?php echo isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : ''; ?>" required>
                 <i class="fas fa-exclamation-circle" style="color: red; display: <?php echo empty($errorConfirm) ?  'none':'inline-block' ; ?>"></i>
             </div>
             <div id="errConfirm" class="error"><?php echo isset($errorConfirm) ? $errorConfirm : ''; ?></div>   
             
              <input type="submit" name="submit" value="REGISTER" class="btn" id="create">
             

              <p class="social-text">Or Sign In With Social Platform</p>
                <div class="social-media">
                    <a href="" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="" class="social-icon"><i class="fab fa-google"></i></a>
                </div>
    
        </form>


            <form class="sign-up-form" method="post">
                <div id="successMessage" class="message valid-message" style="display: none;">
                  User registration successful. Please sign in.
                </div>
                <div id="error-password" class="error"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" required>
                </div>
               

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password">
                </div> 
                

                  <div id="valid-message"></div>
                  <button type="submit" name="login" class="btn"> Log In</button>
        
                
                <p class="social-text">Or Sign In With Social Platform</p>
                <div class="social-media">
                    <a href="" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="" class="social-icon"><i class="fab fa-google"></i></a>
                </div>
            </form>
          </div>
        <div class="panels-container">


            <div class="panel left-panel">
                <div class="content">
                    <button class="btn" id="sign-in-btn">Sign Up</button>
                    <p>Dont have an account? Register now!</p>
                </div>
                <img src="img/logo.transparent.png" class="image"  alt="">
            </div>

        
   
            <div class="panel right-panel">
                <div class="content">
                    <button class="btn" id="sign-up-btn">Sign In</button>
                    <p>Already have an account?</p>
                </div>
                <img src="img/login1.png" class="image"  alt="">
            </div>

        </div>
    </div>


    <script src="../jscript/login.js"></script>
    <script>
    <?php if (isset($_POST['submit']) && empty($errorUsername) && empty($errorPassword) && empty($errorConfirm) && empty($errorEmail)) { ?>
    setTimeout(function() {
        document.getElementById('sign-up-btn').click();
        document.getElementById('successMessage').style.display = 'block';
    }, 100);
    <?php } ?>
</script>

    
</body>
</html>