<!DOCTYPE html>
<html>
<?php session_start();
require_once('includes/head.inc.php') ?>

<body>
	<?php
include_once('includes/nav.inc.php');
include_once('functions.php');
include_once('User.php');
include_once('getUser.php');
include_once('includes/db.inc.php');
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
						<div class="card-header">
							<h1>Edit Profile</h1>
						</div>
						<div class="card-body">

							<form action="uploadfile.php" method="POST" enctype="multipart/form-data" target="_blank">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Add/Change<br/>Profile Photo</label>
									<div class="col-md-6">
										<p><input type="file" name="file"></p>
										<input class="btn btn-secondary btn-sm" type="submit" value="Upload">
										<input class="btn btn-outline-danger btn-sm" type="submit" name="submit" value="Remove Photo" />
									</div>
								</div>
							</form>

							<form name="registration" action="" method="post">

								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Username</label>
									<div class="col-md-6">
										<input class="form-control" type="text" name="username" value="<?php echo $current_user->getUsername() ?>" required disabled>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">First Name</label>
									<div class="col-md-6">
										<input class="form-control" type="text" name="f_name" value="<?php
                                echo $current_user->getFirstName() ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Last Name</label>
									<div class="col-md-6">
										<input class="form-control" type="text" name="l_name" value="<?php
                                echo $current_user->getLastName() ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Birthdate</label>
									<div class="col-md-6">
										<input class="form-control" type="date" name="birthdate" value="<?php
                                echo $current_user->getBirthDate() ?>" required disabled>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Phone Number</label>
									<div class="col-md-6">
										<input class="form-control" type="tel" name="phone" value="<?php echo
                                $current_user->getPhoneNumber() ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="form-group row mb-0">
										<div class="col-md-6 offset-md-4">
											<input class="btn-primary btn" type="submit" name="submit" value="Save Changes" />
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
	<?php require_once ('includes/footer.inc.php')?>
</body>

</html>
