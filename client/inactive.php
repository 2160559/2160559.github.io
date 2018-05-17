<!DOCTYPE html>
<html lang="en">
<?php include 'pagefragments/head.html'?>
<body>
<div style="background: url(images/EagleNewsPh.jpg) no-repeat;
background-size:cover;">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand " href="index.php"><img src="../images/logo2.png" height="50" class="d-inline-block align-top" alt="ABANG"/></a>
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
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="text-center">
                    <img class="card-img-top" src="images/logo.png" alt="Logo">
                    <div class="card-body">
                        <h2 class="card-text" style="color:white">Account Inactive!</h2>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text" style="color:white">Please wait for the account to be marked as
                            approved</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'pagefragments/footer.html'?>
</body>
</html>