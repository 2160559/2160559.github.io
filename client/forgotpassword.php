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
                    An email has been sent to you. Please check your email.
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
    <div class="row justify-content-center m-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h1>Recover Password</h1></div>
                <div class="card-body">
                    <form action="" method="post" name="forgotPassword">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email Address</label>
                            <div class="col-lg-9">
                                <input type="text" name="email_add" class="form-control" placeholder="Email"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary" type="submit">Forgot Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'pagefragments/footer.html'
?>
</body>
</html>