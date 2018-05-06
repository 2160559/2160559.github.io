<!DOCTYPE html>
<html>
<?php include_once('includes/head.inc.php');
include_once('functions.php');
?>
<body>
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
<script type="text/javascript" src="js/main.js"></script>
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
<div class="container p-4">
    <?php include_once('pagefragments/registration_page.html')?>
</div>

<script>
    validateUsername(<?php get_usernames()?>);
</script>
<?php include_once 'includes/footer.inc.php' ?>
</body>
</html>