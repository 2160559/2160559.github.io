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
?>
<div class="container">

    <?php
    if (isset($_REQUEST['username'])) {
        $current_user->setUsername($_REQUEST['username']);
        $current_user->setFirstName($_REQUEST['f_name']);
        $current_user->setLastName($_REQUEST['l_name']);
        $current_user->setBirthDate($_REQUEST['birthdate']);
        $current_user->setPhoneNumber($_REQUEST['phone']);
        $query = "UPDATE `users` SET `username`='" . $current_user->getUsername() . "',`f_name`='" . $current_user->getFirstName() . "',
      `l_name`='" . $current_user->getLastName() . "',`birthdate`='" . $current_user->getBirthDate() . "',
      `phone_number`='" . $current_user->getPhoneNumber() . "' WHERE `id` = '" . $current_user->getUserId() . "'";
        $result = mysqli_query($con, $query) or die("an error occurred");
    } ?>
    <div class="row m-4 pb-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Check Availability</h1></div>
                <div class="card-body">

                    <form name="registration" action="" method="post">

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Check-in</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" name="checkin" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Check-out</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" name="checkout" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="sel1">Guest</label>
                            <div class="col-md-6">
                                <div class="dropdown">
                                    <input type="number" name="no_guests">
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="form-group row">
                        <div class="col-md-4 text-md-right ">
                            <a class="btn btn-info btn-lg" href="transient.php">Back</a>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-info btn-lg btn" name="submit">Check</div>
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