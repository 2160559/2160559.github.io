<!DOCTYPE html>
<html>
<?php session_start();
include 'pagefragments/head.html' ?>
<body>
<?php
include 'pagefragments/nav.inc.php';
include 'includes/db.inc.php';
?>
<div class="container">

    <div class="row m-4 pb-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Book</h1></div>
                <div class="card-body">

                    <form name="registration" action="payment.php" method="post">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Check-in</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" name="checkin" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Check-out</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" name="checkout" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="sel1">Type</label>
                            <div class="col-md-6">
                                <input type="radio" name="post-format" checked/> House
                                &nbsp;&nbsp;
                                <input type="radio" name="post-format" id="room"/> Rooms
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="sel1">Number of Guests</label>
                            <div class="col-md-6">
                                <div class="dropdown">
                                    <input type="number" name="no_guests">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn-info btn btn-lg" name="submit" href="transient.php">Back</a>
                                <input class="btn-info btn btn-lg" name="submit" type="submit" value="Next">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'pagefragments/footer.html' ?>
</body>
</html>