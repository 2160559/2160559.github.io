<?php
session_start();
include 'includes/db.inc.php';
if (isset($_GET['reservation'])){
    if($stmt = $mysqli->prepare("update reservations set status = 'cancelled' where id = ?")){
        $stmt->bind_param('i',$_GET['reservation']);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
    if($stmt = $mysqli->prepare("select room_id reservations where id = ?")){
        $stmt->bind_param('i',$_GET['reservation']);
        $stmt->execute();
        $stmt->bind_result($roomid);
        $stmt->close();
    }
    $mysqli->close();
    if($stmt = $mysqli->prepare("update room set status = 'available' where id = ?")){
        $stmt->bind_param('i',$roomid);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
}
header("Location: profile.php");