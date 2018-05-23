<?php
include 'includes/db.inc.php';
if ($stmt = $mysqli->prepare("INSERT INTO `favorites` (customer_id, house_id) VALUES (?,?)")){
    $stmt->bind_param("ss", $_POST['house_id'], $_POST['user_id']);
    $stmt->execute();
    $stmt->close();
}
$mysqli->close();
header('Location: transient.php');