<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm  mb-4">
<<<<<<< HEAD
	<a class="navbar-brand " href="index.php"><img src="../images/logo%20-%20Copy.png" height="35" class="d-inline-block align-top" alt="ABANG"/></a>
	<div class="collapse navbar-collapse" id="navb">
		<div class="mr-auto">
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control col-form-label-sm mr-sm-2" type="text" placeholder="Search">
				<button class="btn btn-sm btn-outline-info my-2 my-sm-0" type="button">Search</button>
			</form>
		</div>
		<div class="collapse navbar-collapse" id="navb">
			<div class="mr-auto">
			</div>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="">Become a Host</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../saved.php">Saved</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color:white;">
=======
    <a class="navbar-brand " href="index.php"><img src="../images/logo%20-%20Copy.png" height="35" class="d-inline-block align-top" alt="ABANG"/></a>
    <div class="collapse navbar-collapse" id="navb">
        <div class="mr-auto">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control col-form-label-sm mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-sm btn-outline-info my-2 my-sm-0" type="button">Search</button>
            </form>
        </div>
    <div class="collapse navbar-collapse" id="navb">
        <div class="mr-auto">
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Home</a>
            </li>
          <li class="nav-item">
                <a class="nav-link" href="../profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Become a Host</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../saved.php">Saved</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color:white;">
>>>>>>> 31eee3dc2387c9035b5b840c9a891a4192f90daa
                    <img src="profile" alt="">
                    <?php echo $_SESSION['user'][1]?>
                </a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="../editprofile.php">Edit Profile</a>
						<a class="dropdown-item" href="../accountsettings.php">Account Settings</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
					</div>
				</li>
			</ul>
		</div>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>
	</div>
</nav>
