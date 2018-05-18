<!DOCTYPE html>
<html>
<?php
include 'pagefragments/head.html';
session_start();
$current_user = $_SESSION['user'];
?>
<body>
<?php
include 'pagefragments/nav.inc.php';
include 'includes/db.inc.php';
if (isset($_POST['house_id'])) {
    $id = $_POST['house_id'];
    if ($stmt = $mysqli->prepare("SELECT users.f_name, users.l_name, profile_img, `service-provider`.address, house.address, 
                   longitude, latitude, name, description, rules, amenities, cancellations, price, no_room, image 
                  FROM   house JOIN users ON `service-provider` = users.id JOIN `service-provider` ON users.id = 
                  `service-provider`.id JOIN `house-images` ON cover_image = `house-images`.id WHERE house.id = ?")) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($f_name, $l_name, $profile_img, $provider_address, $house_address, $longitude, $latitude, $name,
            $description, $rules, $amenities, $cancellations, $price, $no_rooms, $cover_image);
        $stmt->fetch();
        $stmt->close();
    }
    $mysqli->close();
}
?>
<!-- Main -->
<div class="container">
    <div class="row">
        <div style="border-style:solid;">
            <img src="<?php echo "data:image;base64," . base64_encode($cover_image) ?>" class="img-fluid"
                 style="width: auto">
        </div>
    </div>
    <div class="row">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

            <div class="btn-grp" role="group" aria-label="Second group">
                <div class="btn-group-toggle" data-toggle="buttons">
                    <input class="btn btn-outline-info active btn-lg btn-block" type="submit" name="submit"
                           value="Save to List">
                </div>
            </div>

            <div class="btn-grp" role="group" aria-label="Third group">
                <a class="btn-dark btn btn-lg btn-block" href="checkavail.php" name="submit">Check Availability</a>
            </div>

            <div class="btn-grp" role="group" aria-label="Fourth group">
                <a class="btn-dark btn btn-lg btn-block" href="reservation.php" name="submit">Book Now</a>
            </div>

            <div class="btn-grp" role="group" aria-label="Fourth group">
                <form action="gallery.php" method="post">
                    <input type="text" class="d-none" value="<?php echo $id?>" name="id">
                    <input type="text" class="d-none" value="<?php echo $name?>" name="name">
                    <input type="submit" class="btn btn-dark btn-lg btn-block" value="View Photos">
                </form>
            </div>
        </div>
    </div>

    <br>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1><?php echo $name ?></h1>
            <p><?php echo $description ?></p>
            <p>Address: <?php echo $house_address ?></p>
            <p>Price: <?php echo $price ?></p>
            <p>Number of Rooms: <?php echo $no_rooms ?></p>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-12 col-md-6 mainbox">
            <div id="accordion">

                <div class="card">
                    <div class="card-header bg-info">
                        <div class="collapsed card-link" data-toggle="collapse" href="#col1">
                            Amenities
                        </div>
                    </div>
                    <div id="col1" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                <?php
                                $amenities = explode(', ', $amenities);
                                foreach ($amenities as $amenity) {
                                    echo "<li>$amenity</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <div class="collapsed card-link" data-toggle="collapse" href="#col2">
                            House Rules
                        </div>
                    </div>
                    <div id="col2" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <?php
                                $rules = explode(', ', $rules);
                                foreach ($rules as $rule) {
                                    echo "<li>$rule</li>";
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <div class="collapsed card-link" data-toggle="collapse" href="#col3">
                            Cancellations
                        </div>
                    </div>
                    <div id="col3" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <?php
                                $cancellations = explode('.', $cancellations);
                                foreach ($cancellations as $cancellation) {
                                    echo "<li>$cancellation</li>";
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-6 mainbox">
            <div id="accordion">

                <div class="card">
                    <div class="card-header bg-info">
                        <div class="collapsed card-link" data-toggle="collapse" href="#col4">
                            Map
                        </div>
                    </div>
                    <div id="col4" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <div class="collapsed card-link" data-toggle="collapse" href="#col5">
                            Comments
                        </div>
                    </div>
                    <div id="col5" class="collapse" data-parent="#accordion">
                        <div class="card-body actionBox">
                            <ul class="commentList">
                                <li>
                                    <div class="commenterImage">
                                        <img src="images/EagleNewsPh.jpg"/>
                                    </div>
                                    <div class="commentText">
                                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="commenterImage">
                                        <img src="images/baguio-city.jpg"/>
                                    </div>
                                    <div class="commentText">
                                        <p class="">Hello this is a test comment and this comment is particularly very
                                            long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="commenterImage">
                                        <img src="images/Jonathan-Javier.jpg"/>
                                    </div>
                                    <div class="commentText">
                                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>
                                    </div>
                                </li>
                            </ul>
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Write your comments here..." rows="4"
                                              cols="30"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <div class="collapsed card-link" data-toggle="collapse" href="#col6">
                            The Host
                        </div>
                    </div>
                    <div id="col6" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <img src="<?php echo "data:image;base64," . base64_encode($profile_img) ?>"
                                     class="rounded-circle">
                            </div>
                            <div class="row justify-content-center">
                                <h4><?php echo $f_name . ' ' . $l_name ?></h4>
                            </div>
                            <div class="row justify-content-center">
                                <p><?php
                                    $provider_address = explode(' ', $provider_address);
                                    for ($x = count($provider_address)-1; $x != 0; $x--){
                                        echo $provider_address[$x].', ';
                                    }
                                    ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'pagefragments/footer.html' ?>
</body>

<script>
    function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATtlQ7diHJXSSmEicr81GWSh-d-X4R5NE&callback=initMap">
</script>
</html>


