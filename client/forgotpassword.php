<!DOCTYPE html>
<html>
<?php
include 'pagefragments/head.html';
include 'includes/db.inc.php';
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
                <a class="nav-link" href="http://provider.abang.com/register">Become a Host</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h1>Recover Password</h1></div>
                <div class="card-body">
                    <form action="http://provider.abang.com/cforget" method="post" name="forgotPassword" onsubmit="return validateForm()">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email Address</label>
                            <div class="col-lg-9">
                                <input type="text" name="email_add" class="form-control" placeholder="Email"
                                       id="email_add" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary" type="submit">Forgot Password</button>
                        </div>
                    </form>
                </div>
                <script>
                    function validateForm() {
                        var x = document.forms["forgotPassword"]["email_add"].value;
                        if (x == "") {
                            alert("Email must be filled out");
                            return false;
                        }
                        alert("An email will be sent to the email address you provided, please check that out");
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<?php
include 'pagefragments/footer.html'
?>
</body>
</html>