<!DOCTYPE html>
<html>
<?php
session_start();
$current_user = $_SESSION['user'];
include 'pagefragments/head.html' ?>
<body>
<?php
include 'pagefragments/nav.inc.php';
include 'includes/db.inc.php';

if (isset($_POST['email']) && isset($_POST['confirm_email'])) {
    if ($_POST['email'] != '' && $_POST['confirm_email'] != '') {
        if ($_POST['email'] == $_POST['confirm_email']) {
            if ($stmt = $mysqli->prepare("UPDATE `users` SET `email_add` = ? WHERE `username` = ?")) {
                $username = $current_user['username'];
                $email = $_POST['email'];
                $stmt->bind_param('ss', $email, $username);
                $stmt->execute();
                $stmt->close();
                $current_user['email'] = $_POST['email'];
                $_SESSION['user'] = $current_user;
                echo '
        <div id="alert" class="alert alert-success">
            <strong>Success!</strong>
        </div>
    ';
            }

        }
        $mysqli->close();
    }
}
?>
<script src="js/livevalidation_standalone.js"></script>
<script src="js/validator.js"></script>
<script src="js/main.js"></script>

<div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Change Email</h1>
                    </div>
                    <div class="card-body">
                        <form name="registration" action="" method="post">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Change Email Address</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="email" name="email" placeholder="<?php echo
                                    $current_user['email'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Retype Email Address</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="email" name="confirm_email"
                                           placeholder="<?php echo
                                           $current_user['email'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-primary" href="profile.php">Back</a>
                                    <input class="btn btn-primary" type="SUBMIT" value="Change Email" id="change">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'pagefragments/footer.html' ?>
</body>

</html>