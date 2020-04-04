<?php require_once('../connection.php');

$errors = "" ;
$result = "" ;

if(isset($_POST['submit'])){
    
$username = "";
$email = "";
$password = "";


    

if(isset($_POST['name'])){
    $username = mysqli_real_escape_string($connection,$_POST['name']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,$_POST['pass']);
    

    if (empty($username)) { //Name cannot be empty
        $errors = 'Name cannot be blank';
    }
    elseif(empty($email)){
        $errors = 'Email cannot be blank';
    }
    elseif(empty($password)){
        $errors = 'Password cannot be blank';
    }
}

if (empty($errors)) { //If errors in validation
    $hashed_password=sha1($password);
    $sql="INSERT INTO tourguide (username,email,password) VALUES ('{$username}','{$email}','{$hashed_password}')";
    $result=mysqli_query($connection,$sql);

    if ($result==true){
        $result = "Successfull !";
    }
    else{
        $errors = "Email already in use";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
body {
  background-image: url('image1.jpg');
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<body>

    <div class="main">

        <h1>Sign up</h1>
        <div class="container">
            <div class="sign-up-content">
                <form action="registration.php" method='POST' class="signup-form">
                    <h2 class="form-title">Join With Us</h2>
                   
                    <div id="result" name="result"><?php if (!empty($result)){echo $result;}
                                                        else{echo $errors;}?></div>
                    <div class="form-textbox">
                        <label for="name">Full name</label>
                        <input type="text" name="name" id="name" required/>
                    </div>

                    <div class="form-textbox">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required/>
                    </div>

                    <div class="form-textbox">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" required/>
                    </div>
					<br/>
                    <div class="form-textbox">
                        <input type="submit" name="submit" id="submit" class="submit" value="Create account" />
                    </div>
                    <span class="throw_error"></span>
                    <span id="success"></span>
                </form>
		
                <p class="loginhere">
                    Already have an account ?<a href="#" class="loginhere-link"> Log in</a>
                </p>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>