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
if (isset($_POST['old_password'])) {
    if (password_verify($_POST['old_password'], $current_user['password'])) {
        if ($_POST['new_password'] != '' || $_POST['confirm_password'] != '') {
            if ($_POST['new_password'] != $_POST['confirm_password']) {
                echo '
        <div id="alert" class="alert alert-warning">
            <strong>Passwords do not match!</strong>
        </div>
    ';
            } else {
                if ($stmt = $mysqli->prepare("UPDATE `users` SET `password` = ? WHERE `username` = ?")) {
                    $username = $current_user['username'];
                    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('ss', $password, $username);
                    $stmt->execute();
                    $stmt->close();
                    $current_user['password'] = $_POST['new_password'];
                    $_SESSION['user'] = $current_user;
                    echo '
        <div id="alert" class="alert alert-success">
            <strong>Success!</strong>
        </div>
    ';
                }
                $mysqli->close();
            }
        }
    } else {
        echo '
        <div id="alert" class="alert alert-warning">
            <strong>Wrong old Password</strong>
        </div>
    ';
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
                        <h1>Account Settings</h1>
                    </div>
                    <div class="card-body">
                        <form name="registration" action="" method="post">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Old Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="old_password"
                                           placeholder="Old Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">New Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="new_password"
                                           placeholder="Password"
                                           id="password"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Retype Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="confirm_password"
                                           id="confpass" placeholder="Password"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-primary" href="profile.php">Back</a>
                                    <input class="btn-primary btn" type="submit" name="submit" value="Save
                                        Changes"/>
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