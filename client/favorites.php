<!DOCTYPE html>
<html>
<?php
session_start();
$current_user = $_SESSION['user'];
include 'pagefragments/head.html';
?>
<body>
<?php
include 'pagefragments/nav.inc.php';
include 'includes/db.inc.php';
if ($stmt = $mysqli->prepare("SELECT house_id, image, house.name AS house_name FROM favorites JOIN 
        house ON house_id = house.id JOIN `house-images` ON cover_image = `house-images`.id WHERE customer_id = ? ")) {
    $houses = [];
    $stmt->bind_param("s", $current_user['id']);
    $stmt->execute();
    $stmt->bind_result($house_id, $house_image, $house_name);

    while ($stmt->fetch()) {
        $houses[] = array('house_id' => $house_id, 'house_image' => $house_image, 'house_name' => $house_name);
    }
    $stmt->close();
}
$mysqli->close();
?>
<!-- Main -->
<div class="container" style="margin-top: 25px;">
    <div class="container col-md-8" id="main">
        <div class="row">

            <?php
            if (count($houses)!=0){
            foreach ($houses as $house) {
                ?>
                <a class="col-sm-12 col-md-5 mainbox alert alert-secondary alert-dismissible fade show "
                   style="background: url(<?php echo 'data:image;base64,' . base64_encode($house['house_image']) ?>) no-repeat;"
                   href="../transient.php?house_id=<?php echo $house['house_id'] ?>">
                    <h1 style="color: white"><?php echo $house['house_name'] ?></h1>
                    <button type="button" class="close" data-dismiss="alert"
                            onclick="location.href = 'removefav.php?house_id=<?php echo $house['house_id'] ?>&user_id=<?php echo $current_user['id']?>'">
                        &times;
                    </button>
                </a>
            <?php }
            }else{
                echo "<h1>You don't have any favorites!</h1>";
            }
            ?>
        </div>
    </div>
</div>

<?php include 'pagefragments/footer.html' ?>
</body>
</html>