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
      $transient = $_SESSION['transient'];
      $rooms_available = [];
      $current_date = date('Y-m-d')
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
                  <div class="col-md-4 text-md-right ">
                    <button class="btn-info btn-lg btn" name="submit" type="submit">Check</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <br>
          <?php
        if (isset($_GET['checkin']) && isset($_GET['checkout'])) {
          if ($_GET['checkin'] < $current_date || $_GET['checkout'] < $current_date) {
            echo "<script>alert('Invalid Date')</script>";
          } else {
            if ($stmt = $mysqli->prepare("select id, area, no_beds from room where id not in(SELECT DISTINCT `room-id` FROM reservations WHERE `check-in` <= ? 
and `check-out` >= ?) and status != 'reserved' and house_id = ?;")) {
              $stmt->bind_param('ssi', $_GET['checkin'], $_GET['checkout'], $transient['id']);
              $stmt->execute();
              $stmt->bind_result($id, $area, $beds);
              while ($stmt->fetch()) {
                $rooms_available[] = array($area, $beds, $id);
              }
              $stmt->close();
            }
            if (count($rooms_available)>0) {
          ?>
          <div class="card p-4">
            <h1>Rooms Available</h1>
            Number of Rooms of House: <?php echo $transient['no-rooms'] ?>
            <?php echo "
                 <form action='reserve.php' method='post'>
                    <input type='date' name='no-rooms' value='" . $transient['no-rooms'] . "' class='d-none'>
                    <input type='date' name='checkin' value='" . $_GET['checkin'] . "' class='d-none'>
                    <input type='date' name='checkout' value='" . $_GET['checkout'] . "' class='d-none'>
                    <input type='text' name='houseid' value='" . $transient['id'] . "' class='d-none'>
                    <input type='text' name='userid' value='" . $current_user['id'] . "' class='d-none'>
                  </form>
                    <button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modalForReservation'>Reserve House</button>";
            ?>
            <table class="table table-striped text-center">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Area(m)</th>
                  <th scope="col">Number of Beds</th>
                  <th scope="col">Reserve</th>
                </tr>
              </thead>
              <tbody>
                <?php
              $num = 0;

              foreach ($rooms_available as $room) {
                $num++;
                echo "
                        <tr>
                            <th scope='row'>" . $num . "</th>
                            <td>" . $room[0] . "</td>
                            <td>" . $room[1] . "</td>
                            <td>
                                <form action='reserve.php' method='post'>
                                    <input type='date' name='checkin' value='" . $_GET['checkin'] . "' class='d-none'>
                                    <input type='date' name='checkout' value='" . $_GET['checkout'] . "' class='d-none'>
                                    <input type='text' name='roomid' value='" . $room[2] . "' class='d-none'>
                                    <input type='text' name='userid' value='" . $current_user['id'] . "' class='d-none'>
                                    </form>
                                    <button name='submitroom' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modalForReservation'>Reserve Room</button>
                            </td>
                        </tr>
                        ";
              } ?>
              </tbody>
            </table>

          </div>
          <?php
            }else{
              echo "<script>alert('No Rooms Available for this House for the dates specified')</script>";
            }
          }
          $mysqli->close();
        } ?>

          <!-- Modal -->
          <div class="modal fade" id="modalForReservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Confirm Reservation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
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
                    <hr>
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label text-md-right">No. of pax</label>
                      <div class="col-md-6">
                        <input class="form-control" type="number" name="no" required>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <h6 class="col text-right">Total Amount:</h6>
                      <h6 class="col">PHP 00.00</h6>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info">Confirm</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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