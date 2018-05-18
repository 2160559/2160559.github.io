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

function deactivate($mysqli, $current_user)
{
    if ($stmt = $mysqli->prepare("UPDATE `users` SET `status` = 'deactivated' WHERE `username` = ?")) {
        $username = $current_user['username'];
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
    header('Location: deactivated.php');
}

if (isset($_GET['submit'])) {
    deactivate($mysqli, $current_user);
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
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <input class="btn-info btn" type="submit" name="submit" value="Save Changes"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-6">
                            <button class="btn btn-danger btn-sm" id="btn-confirm">Deactivate Account</button>
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                 aria-hidden="true" id="mi-modal">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Are you sure you want to
                                                deactivate your account?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="accountsettings.php?submit=true" class="btn btn-default"
                                               id="modal-btn-si">Yes</a>
                                            <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#alert').delay(5000).fadeOut(400);
    var modalConfirm = function (callback) {

        $("#btn-confirm").on("click", function () {
            $("#mi-modal").modal('show');
        });

        $("#modal-btn-si").on("click", function () {
            callback(true);
            $("#mi-modal").modal('hide');
        });

        $("#modal-btn-no").on("click", function () {
            callback(false);
            $("#mi-modal").modal('hide');
        });
    };

    modalConfirm(function (confirm) {
        if (confirm) {
            //Acciones si el usuario confirma
            $("#result").html("CONFIRMADO");

        } else {
            //Acciones si el usuario no confirma
            $("#result").html("NO CONFIRMADO");
        }
    });
</script>
<?php include 'pagefragments/footer.html' ?>
</body>

</html>