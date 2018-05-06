<?php
require_once('functions.php');
$current_user = add_user();
$email = $current_user->getEmailAdd();
$result = add_user_to_database($current_user);
$query = "SELECT * FROM `users` WHERE email_add='$email'";
$con = mysqli_connect("localhost", "root", "", "initial") or die("Connection failed");
$result = mysqli_query($con, $query) or die("an error occurred");
if ($result) {
    session_start();
    $_SESSION['id'] = $current_user->getUserId() . rand(1, 50);
    $_SESSION['user'] = mysqli_fetch_row($result);
    header('Location: index.php');
}
