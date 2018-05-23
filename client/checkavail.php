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
        if (isset($_GET['checkin']) && isset($_GET['checkout'])){
            if($stmt = $mysqli->prepare("select * from room where id not in(SELECT DISTINCT `room-id`FROM reservations WHERE `check-in` <= ? and `check-out` >= ?) and status != 'reserved'")){
                $stmt->bind_param('ss', $_GET['checkin'],$_GET['checkout']);
                $stmt->execute();

            }
        }
    ?>
    <div class="row m-4 pb-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Check Availability</h1></div>
                <div class="card-body">

                    <form action="" method="get">
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
                            <div class="col-md-4 text-md-right ">
                                <a class="btn btn-info btn-lg" href="transient.php">Back</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn-info btn-lg btn" name="submit" type="submit">Check</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'pagefragments/footer.html'?>
</body>
</html>