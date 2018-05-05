<!DOCTYPE html>
<html>
<?php include_once('includes/head.inc.php')?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand " href="index.php"><img src="../images/logo%20-%20Copy.png" height="50" class="d-inline-block align-top" alt="ABANG"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navb">
        <div class="mr-auto">

        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="">Become a Host</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registration.php">Sign Up</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container" style="margin-top: 50px">
<<<<<<< HEAD
    <?php
    require('includes/db.inc.php');
    session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['email'])) {
        // removes backslashes
        $email = stripslashes($_REQUEST['email']);
        //escapes special characters in a string
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //Checking is user existing in the database or not
        echo $query = "SELECT * FROM `users` WHERE email_add='$email' and pass='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die("an error occurred");
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_row($result);
        $current_user= new User($rows[0], $row[1] ,$row[2],$row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);

        if ($rows == 1) {
            $_SESSION['id'] = $email;
            // Redirect user to index.php
            //header("Location: index.php");
        } else {
            echo "<div class='form'>
=======
<?php
//require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);
    //Checking is user existing in the database or not
    echo $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
//    $result = mysqli_query($con,$query) or die("an error occurred");
   // $rows = mysqli_num_rows($result);
    if($rows==1){
        $_SESSION['username'] = $username;
        // Redirect user to index.php
        header("Location: index.php");
    }else{
        echo "<div class='form'>
>>>>>>> abb5b867cc252fd8119f4acdf2384eb09e29ec59
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
    }
}else{?>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><h1>Login</h1></div>
                <div class="card-body">
                    <form action="" method="post" name="login">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="username" placeholder="Your Username Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Password</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="submit" class="btn btn-info" value="Login">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>
</body>
</html>