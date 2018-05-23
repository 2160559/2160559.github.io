<!DOCTYPE html>
<html>
<?php
include 'pagefragments/head.html';
include 'includes/db.inc.php';
?>
	<script src="js/livevalidation_standalone.js"></script>
	<script src="js/validator.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>

	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand " href="index.php"><img src="../images/logo%20-%20Copy.png" height="50"
                                                   class="d-inline-block align-top" alt="ABANG"/></a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>

			<div class="collapse navbar-collapse" id="navb">
				<div class="mr-auto">

				</div>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="login.php">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="registration.php">Sign Up</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">Become a Host</a>
					</li>
				</ul>
			</div>
		</nav>
		`
		<div class="container p-4">
			<?php
    if (isset($_POST['username'])) {
        if ($stmt = $mysqli->prepare("INSERT INTO `users` (username, f_name, l_name, email_add, password, phone, 
            acc_type, birthday, `status`) VALUES (?,?,?,?,?,?,?,?,?)")) {
            $username = $_POST['username'];
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $phone = $_POST['phone'];
            $birthdate = $_POST['birthdate'];
            $acc_type = 'customer';
            $status = 'pending';
            $current_user = array('username' => $username, 'first_name' => $f_name, 'last_name' => $l_name, 'email' =>
                $email, 'password' => $password, 'phone' => $phone, 'birthdate' => $birthdate, 'acc_type' =>
                $acc_type, 'status' => $status);
            $stmt->bind_param('sssssssss', $username, $f_name, $l_name, $email, $password, $phone, $acc_type,
                $birthdate, $status);
            $stmt->execute();
			print_r($stmt);
            $stmt->close();
			session_start();
        $_SESSION['id'] = session_create_id();
        $_SESSION['user'] = $current_user;
        header('Location: index.php');
        }
        $mysqli->close();
    } else {
        include 'pagefragments/registration_page.html';
    }
    ?>
		</div>
		<?php include 'pagefragments/footer.html' ?>
	</body>

</html>
