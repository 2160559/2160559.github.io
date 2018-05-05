<!DOCTYPE html>
<html>
<?php include_once ('includes/head.inc.php')?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light margin-left">
    <a class="navbar-brand" href="index.php">ABANG</a>
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
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
    print_r($_REQUEST);
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    $firstname = stripslashes($_REQUEST['f_name']);
    $lastname = stripslashes($_REQUEST['l_name']);
    $email = stripslashes($_REQUEST['email']);
    $password = stripslashes($_REQUEST['password']);
    $birthdate = date($_REQUEST['birthdate']);
    $phone = stripslashes($_REQUEST['phone']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con,$username);

    $email = mysqli_real_escape_string($con,$email);

    $password = mysqli_real_escape_string($con,$password);
    $trn_date = date("Y-m-d H:i:s");
    //$query = "INSERT into `users` (username, password, email, trn_date)VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
    //$query = "INSERT INTO `users`(username, f_name, l_name, acc_type, email_add, pass, birthdate, phone_number)
    // VALUES ('$username','$firstname','$lastname','customer','$email', '".md5($password)."','$birthdate','$phone')";
    $query = "INSERT INTO `users`(`username`, `f_name`, `l_name`, `acc_type`, `email_add`, `pass`, `birthdate`, `profile_img`, `phone_number`) VALUES ('Gaspar','Gaspar','Gaspar','customer','email','pass','1111-11-11','asdf','1234')";
    $result = mysqli_query($con,$query);
    if($result){
        session_start();
        $_SESSION['username'] =  stripslashes($_REQUEST['username']);
        header('Location: index.php');
    }
}else{
    ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Registration</h1></div>
                <div class="card-body">
                    <form name="registration" action="" method="post">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">First Name</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="f_name" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">First Name</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="l_name" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6">
                                <input class="form-control" type="email" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Birthdate</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" name="birthdate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Phone Number</label>
                            <div class="col-md-6">
                                <input class="form-control" type="tel" name="phone" placeholder="09090909090" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input class="form-control" type="password" name="password" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input class="form-control" type="password" name="confirm_password" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input class="btn-primary btn" type="submit" name="submit" value="Register" />
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