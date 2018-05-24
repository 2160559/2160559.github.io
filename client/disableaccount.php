<?php
include 'includes/db.inc.php';
session_start();
$current_user = $_SESSION['user'];
if (isset($_GET['disable'])){
    if ($stmt = $mysqli->prepare("UPDATE users set status = 'deactivated' where id = ?")){
        $stmt->bind_param("i", $current_user['id']);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
    session_destroy();

    header("Location:index.php");
}