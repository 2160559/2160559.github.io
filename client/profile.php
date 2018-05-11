<!DOCTYPE html>
<html>
<?php session_start();
require_once('includes/head.inc.php') ?>
<body>
<?php
include_once('includes/nav.inc.php');
?>

<div class="container">
    <div class="row profile">
      <!-- SIDE PROFILE -->
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
                  <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						My Name
					</div>
					<div class="profile-usertitle-username">
						@username
					</div>
                    <div class="profile-usertitle-birthday">
						Birthday: Month 00, 0000
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
                <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                  <p class="profile-usertitle-name">Booking History</p>
                </nav>      
                    <br>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Check-in</th>
                          <th scope="col">Check-out</th>
                          <th scope="col">Place</th>
                          <th scope="col">Amount Paid</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                
              </div>
            </div>
		</div>
	</div>
</div>

    <?php require_once ('includes/footer.inc.php')?>
</body>
</html>