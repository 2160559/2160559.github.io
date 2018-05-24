<!DOCTYPE html>
<html>
  <?php
  session_start();
  $current_user = $_SESSION['user'];
  include 'pagefragments/head.html';
  include 'includes/db.inc.php';
  ?>
  <body>
    <?php
    include 'pagefragments/nav.inc.php';
    $reservations = [];

    if ($stmt = $mysqli->prepare("SELECT reservations.id, `check-in`, `check-out`, `address`,reservations.status FROM reservations join room on `room-id` = room
.id join 
house on 
house_id = house.id join users on `customer-id` = users.id WHERE username = ?;")) {
      $stmt->bind_param('s', $current_user['username']);
      $stmt->execute();
      $stmt->bind_result($id, $check_in, $check_out, $address, $status);
      while ($stmt->fetch()) {
        $reservations[] = array($check_in, $check_out, $address,$status, $id);
      }
      $stmt->close();
    }
    $mysqli->close();
    ?>

    <div class="container">
      <div class="row profile">
        <!-- SIDE PROFILE -->
        <div class="col-md-3">
          <div class="profile-sidebar">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
              <img src="<?php if ($current_user['profile_img'] !='') {
  echo "data:image;base64," . base64_encode($current_user['profile_img']);
}else{
  echo "../images/default-profile.png";
} ?>"
                   class="mx-auto img-fluid img-circle d-block" alt="avatar">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php echo $current_user['first_name'] . ' ' . $current_user['last_name'] ?>
              </div>
              <div class="profile-usertitle-username">
                <?php echo $current_user['username'] ?>
              </div>
              <div class="profile-usertitle-birthday">
                Birthday:
                <?php
  $b_day = date_create($current_user['birthdate']);
                echo date_format($b_day, 'jS F Y');
                ?>
              </div>
              <div class="profile-usertitle-birthday">
                <?php echo $current_user['email'] ?>
                <a href="changeemail.php">Edit</a>
              </div>
              <div class="profile-usertitle-birthday">
                <a href="changepassword.php">Change Password</a>
              </div>
              <div>
                <a class="btn btn-primary" href="editprofile.php">Edit Profile</a>
              </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS
<div class="profile-userbuttons">
<button type="button" class="btn btn-info btn-sm">Message</button>
</div>
-->
          </div>
        </div>
        <!-- END SIDE PROFILE -->
        <div class="col-md-9">
          <div class="profile-content">
            <div class="bd-example bd-example-tabs">
              <p class="profile-usertitle-name">Checking History</p>
              <table class="table table-striped">
                <thead>
                  <th>Check-in</th>
                  <th>Check-out</th>
                  <th>Place</th>
                  <th>Status</th>
                  <th>Update</th>
                </thead>
                <tbody>
                  <?php
  if (count($reservations) > 0) {
    foreach ($reservations as $reservation) {
      $status = $reservation[3];
      $change = "";
      if ($status!="cancelled" && $status != "checked-out"){
        $change = "<button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#confirmation'>Cancel</button>";
      }

      
      echo "
                                <tr>
                                    <td>$reservation[0]</td>
                                    <td>$reservation[1]</td>
                                    <td>$reservation[2]</td>
                                    <td>$reservation[3]</td>
                                    <td>$change</td>
                                </tr>
                                ";
    }
  } else {
    echo '<tr>
                                   <td colspan="4">No Record</td>
                                </tr>';
  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Confirm Cancellation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body mx-auto justify-content-center">
                  <h6>Cancel Reservation?</h6><br>
                  <div class="form-group row">
                    <a class="btn btn-info" href="#">Yes, cancel my reservation.</a><pre>  </pre>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No, go back to my profile.</button>
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