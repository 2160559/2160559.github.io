<!DOCTYPE html>
<html>
<?php
include_once('includes/head.inc.php');
include_once('User.php');
include_once('includes/db.inc.php');
?>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand " href="index.php"><img src="../images/logo%20-%20Copy.png" height="50"
                                                   class="d-inline-block align-top" alt="ABANG"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navb">
        <div class="mr-auto">

        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registration.php">Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Become a Host</a>
            </li>
        </ul>
    </div>
</nav>
<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<div class="container">
    <?php

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
        $query = "SELECT * FROM `users` WHERE email_add='$email' and pass='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die("an error occurred");
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_row($result);
        $current_user = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8],
            $row[9]);
        if ($rows == 1) {
            $_SESSION['id'] = $current_user->getUserId() . rand(1, 50);
            $_SESSION['user'] = $row;
            // Redirect user to index.php
            header("Location: index.php");
        } else {
            include('pagefragments/login_page.html');
            ?>
            <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                 aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Error!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Invalid Username/Password
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(window).on('load', function () {
                    $('#modal').modal('show');
                });
            </script>
            <?php
        }
    } else {
        include('pagefragments/login_page.html');
    } ?>
</div>
<?php include_once 'includes/footer.inc.php' ?>
</body>
</html>