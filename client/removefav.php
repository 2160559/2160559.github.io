<?php
include 'includes/db.inc.php';
if ($stmt = $mysqli->prepare("DELETE FROM `favorites` WHERE  customer_id = ? AND house_id = ?")){
    $stmt->bind_param("ss", $_GET['user_id'], $_GET['house_id']);
    $stmt->execute();
    $stmt->close();
}
$mysqli->close();
header('Location: favorites.php');