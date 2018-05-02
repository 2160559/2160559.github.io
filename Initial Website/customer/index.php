<?php
//include auth.inc.php file on all secure pages

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
    <?php

    if (isset($_SESSION['username'])){?>
        <p>Welcome!<?php $_SESSION['username'] ?> </p>;
        <p><a href="">Dashboard</a></p>
        <a href="logout.php">Logout</a>
    <?php } else{ ?>
        <p><a href="login.php">Login</a></p>
    <?php } ?>
</div>
</body>
</html>