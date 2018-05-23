<?php
session_start();
include 'includes/db.inc.php';
$current_user = $_SESSION['user'];
$transient = $_SESSION['transient'];
if (isset($_POST['comment']) && isset($_POST['rating'])) {
    $dt = new DateTime();
    echo $date = $dt->format('Y-m-d');
    if ($stmt = $mysqli->prepare("INSERT INTO reviews(`customer-id`, `house-id`, rating, message, `date-reviewed`) VALUES(?,?,?,?,?)")) {
        $stmt->bind_param('iiiss',$current_user['id'],$transient['id'], $_POST['rating'], $_POST['comment'], $date);
        $stmt->execute();
        print_r($stmt);
        $stmt->close();
    }else
        echo "Failed";
    $mysqli->close();
   header("Location: transient.php?house_id=".$transient['id']);
}