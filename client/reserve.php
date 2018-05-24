<?php
include 'includes/db.inc.php';
$date = date('Y-m-d');
if (isset($_POST['submitroom'])){
    if ($stmt = $mysqli->prepare("insert into reservations (`customer-id`, `room-id`, `date-reserved`, `check-in`, `check-out`, status) values (?,?,?,?,?,'pending')")){
        $stmt->bind_param('sssss', $_POST['userid'],$_POST['roomid'],$date, $_POST['checkin'], $_POST['checkout']);
        $stmt->execute();
        $stmt->close();
    }
    if ($stmt = $mysqli->prepare("UPDate room set status='reserved' where id =?;")){
        $stmt->bind_param('s', $_POST['roomid']);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
}
if (isset($_POST['submithouse'])){
    $roomids= [];
    if ($stmt=$mysqli->prepare("select id from room where house_id=?")){
        $stmt->bind_param('s', $_POST['houseid']);
        $stmt->execute();
        print_r($stmt)."<Br>";
        $stmt->bind_result($roomid);
        while ($stmt->fetch()){
            $roomids[] = $roomid;
        }
        print_r($roomids)."<Br>";
        $stmt->close();
    }
    foreach ($roomids as $roomid){
        if ($stmt = $mysqli->prepare("insert into reservations (`customer-id`, `room-id`, `date-reserved`, `check-in`, `check-out`, status) values (?,?,?,?,?,'pending')")){
            $stmt->bind_param('sssss', $_POST['userid'],$roomid,$date, $_POST['checkin'], $_POST['checkout']);
            $stmt->execute();
            print_r($stmt)."<Br>";
            $stmt->close();
        }
        if ($stmt = $mysqli->prepare("UPDate room set status='reserved' where id =?;")){
            $stmt->bind_param('s', $roomid);
            $stmt->execute();
            print_r($stmt)."<Br>";
            $stmt->close();
        }
    }
    $mysqli->close();
}
header('Location: checkavail.php');