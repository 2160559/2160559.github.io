<!DOCTYPE html>
<html>
  <?php session_start();
  require_once('includes/head.inc.php') ?>
  <body>
    <?php include_once('includes/nav.inc.php') ?>
    <?php
    include_once('includes/nav.inc.php');
  include_once('functions.php');
  include_once('User.php');
  include_once('getUser.php');
  include_once('includes/db.inc.php');
    ?>
    <div class="container">
      <?php
      if (isset($_REQUEST['email'])) {
        $current_user->getEmailAdd($_REQUEST['email']);
        $current_user->setPassword($_REQUEST['password']);
        $query = "UPDATE `users` SET `email_add`='" . $current_user->getEmailAdd() . "',`pass`='" .
          md5($current_user->getPassword()). "' WHERE `id` = '" . $current_user->getUserId() . "'";
        $result = mysqli_query($con, $query) or die("an error occurred");
      } ?>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header"><h1>Account Settings</h1></div>
            <div class="card-body">
              <br/>
              <p class="profile-usertitle-name text-center">A temporary password will be sent to your email.</p>
              <br/>
              <form name="registration" action="" method="post">
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Change Email Address</label>
                  <div class="col-md-6">
                    <input class="form-control" type="email" name="email" value="<?php echo
  $current_user->getEmailAdd()?>"
                           required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"></div>
                  <div class="col-md-6">
                    <input class="btn-info btn float-right" type="submit" name="submit"  value="Send"/>
                  </div>
                </div>
              </form>
              <div class="form-group row mb-0">
                <div class="col-md-4 col-form-label text-md-right">
                  <a href="index.php">Go back to homepage</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once('includes/footer.inc.php') ?>
  </body>
</html>