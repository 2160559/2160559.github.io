<!DOCTYPE html>
<html>
<?php
session_start();
@$current_user = $_SESSION['user'];
include 'pagefragments/head.html' ?>

<body>
<?php
include 'pagefragments/nav.inc.php';
include 'includes/db.inc.php';

if (isset($_POST['phone'])) {
    if ($stmt = $mysqli->prepare("UPDATE `users` SET `phone` = ? WHERE `username` = ?")) {
        $username = $current_user['username'];
        $phone = $_POST['phone'];
        $stmt->bind_param('ss', $phone, $username);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
    $current_user['phone'] = $_POST['phone'];
    echo '
        <div id="alert" class="alert alert-success">
            <strong>Success!</strong>
        </div>
    ';
} elseif (isset($_POST['delete'])) {
    if ($stmt = $mysqli->prepare("UPDATE users SET profile_img = '' WHERE email_add = ?")) {
        $stmt->bind_param('s', $current_user['email']);
        $stmt->execute();
        $stmt->close();
        $current_user['profile_img'] = '';
        $_SESSION['user'] = $current_user;
    }
    $mysqli->close();
    echo '
        <div id="alert" class="alert alert-success">
            <strong>Success!</strong>
        </div>
    ';
}

include 'upload_img.php';
?>
<script>$('#alert').delay(5000).fadeOut(400)</script>
<div class="container">
    <div class="row m-4 pb-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Profile</h1>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Add/Change<br/>Profile Photo</label>
                            <div class="col-md-6">
                                <input type="hidden" name="MAX_FILE_SIZE" value="500000">
                                <p><input type="file" name="userfile"></p>
                                <input class="btn btn-secondary btn-sm" type="submit" name="submit_image"
                                       value="Upload">
                            </div>
                        </div>
                    </form>
                    <form action="" method="post">
                        <div class="form-group row justify-content-center">
                            <input type="submit" class="btn btn-outline-danger btn-sm" name="delete" value="Remove
                                Photo">
                        </div>
                    </form>
                    <form action="" method="post">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="username"
                                       value="<?php echo $current_user['username'] ?>" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">First Name</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="f_name" value="<?php
                                echo $current_user['first_name'] ?>" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Last Name</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="l_name" value="<?php
                                echo $current_user['last_name'] ?>" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Birthdate</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="birthdate" value="<?php
                                echo $current_user['birthdate'] ?>" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Phone Number</label>
                            <div class="col-md-6">
                                <input class="form-control" type="tel" name="phone" value="<?php echo
                                $current_user['phone'] ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <a href="profile.php" class="btn btn-primary">Back</a>
                                <input class="btn-primary btn" type="submit" name="submit" value="Save Changes"/>
                            </div>
                        </div>
                    </form>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <b  class="btn btn-danger" data-toggle="modal" data-target="#myModal">Disable Account</b>
                        </div>
                    </div>
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Warning!</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    Are you sure you want to Deactivate Your account?
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <a href="disableaccount.php?disable=true" class="btn btn-danger">Disable</a>
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'pagefragments/footer.html' ?>
</body>

</html>
