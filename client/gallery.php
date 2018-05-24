<!DOCTYPE html>
<html>
<?php
session_start();
$current_user = $_SESSION['user'];
include 'pagefragments/head.html'
?>
<body>
<?php
include 'pagefragments/nav.inc.php';
include 'includes/db.inc.php';
if ($stmt = $mysqli->prepare("select image from `house-images` where `house-id` = ?")) {
    $stmt->bind_param('i', $_POST['id']);
    $stmt->execute();
    $stmt->bind_result($img);
    $images = [];
    while ($stmt->fetch()) {
        $images[] = $img;
    }
}
?>
<!-- Main -->
<div class="container">
    <section class="gallery-block compact-gallery">
        <div class="container">
            <div class="heading">
                <a class="btn btn-info btn-lg float-left" href="transient.php">Back</a>
                <h2><?php echo $_POST['name']?></h2>
            </div>
            <div class="row no-gutters">
                <?php
                foreach ($images as $image) {
                    echo "
                        <div class='col-md-4 item zoom-on-hover' style='background: transparent'>
                            <img class='image img-fluid' src='".'data:image;base64,'. base64_encode($image)."'>
                        </div>
                        ";
                }
                ?>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.compact-gallery', {animation: 'slideIn'});
    </script>
</div>
<?php include 'pagefragments/footer.html' ?>
</body>

</html>


