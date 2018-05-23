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
if (isset($_GET['house_id'])) {
    $id = $_GET['house_id'];
    if ($stmt = $mysqli->prepare("SELECT users.f_name, users.l_name, profile_img, `service-provider`.address, house.address, 
                   longitude, latitude, name, description, rules, amenities, cancellations, FORMAT(price,2) as price, no_room, image 
                  FROM   house JOIN users ON `service-provider` = users.id JOIN `service-provider` ON users.id = 
                  `service-provider`.id JOIN `house-images` ON cover_image = `house-images`.id WHERE house.id = ?")) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($f_name, $l_name, $profile_img, $provider_address, $house_address, $longitude, $latitude, $name,
            $description, $rules, $amenities, $cancellations, $price, $no_rooms, $cover_image);
        $stmt->fetch();
        $_SESSION['transient'] = array('id' => $id, 'provider-name' => $f_name .
            ' ' . $l_name, 'provider-img' => $profile_img,
            'provider-address' => $provider_address, 'house-address' => $house_address, 'longitude' => $longitude,
            'latitude' => $latitude, 'house-name' => $name, 'description' => $description, 'rules' => $rules,
            'amenities' => $amenities, 'cancellations' => $cancellations, 'price' => $price, 'no-rooms' => $no_rooms,
            'cover_image' => $cover_image);
        $stmt->close();
    }
    $mysqli->close();
}
$transient = $_SESSION['transient'];
$comments = [];
if ($stmt = $mysqli2->prepare("SELECT username, profile_img, rating, message, `date-reviewed` from reviews join users on `customer-id` = users.id 
where `house-id` = ?")) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($username, $profile_img, $rating, $message, $date);
    while ($stmt->fetch()) {
        $comments[] = array('username' => $username, 'profile_img' => $profile_img, 'rating' => $rating,
            'message' => $message, 'date' => $date);
    }
    $stmt->close();
}
$mysqli2->close();
?>
<!-- Main -->
<div class="container">
    <div class="row">
        <div style="border-style:solid;">
            <img src="<?php echo "data:image;base64," . base64_encode($transient['cover_image']) ?>" class="img-fluid"
                 style="width: auto">
        </div>
    </div>
    <div class="row">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

            <div class="btn-grp" role="group" aria-label="Second group">
                <div class="btn-grp" role="group" aria-label="First group">
                    <form action="addtofav.php" method="post">
                        <input type="text" class="d-none" value="<?php echo $transient['id'] ?>" name="user_id">
                        <input type="text" class="d-none" value="<?php echo $current_user['id'] ?>" name="house_id">
                        <input type="submit" class="btn btn-dark btn-lg btn-block" value="Add to Favorites">
                    </form>
                </div>
            </div>
            <div class="btn-grp" role="group" aria-label="Fourth group">
                <a class="btn-dark btn btn-lg btn-block" href="checkavail.php" name="submit">Reserve Now</a>
            </div>

            <div class="btn-grp" role="group" aria-label="Fourth group">
                <form action="gallery.php" method="post">
                    <input type="text" class="d-none" value="<?php echo $transient['id'] ?>" name="id">
                    <input type="text" class="d-none" value="<?php echo $transient['house-name'] ?>" name="name">
                    <input type="submit" class="btn btn-dark btn-lg btn-block" value="View Photos">
                </form>
            </div>
        </div>
    </div>

    <br>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1><?php echo $transient['house-name'] ?></h1>
            <p><?php echo $transient['description'] ?></p>
            <p>Address: <?php echo $transient['house-address'] ?></p>
            <p>Price: Php <?php echo $transient['price'] ?> per person per night</p>
            <p>Number of Rooms: <?php echo $transient['no-rooms'] ?></p>
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
                                $amenities = explode(', ', $transient['amenities']);
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
                                $rules = explode(', ', $transient['rules']);
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
                                $cancellations = explode('.', $transient['cancellations']);
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
                            <div style="width: 100%">
                                <iframe src="https://www.google.com/maps/embed/v1/view?key=AIzaSyA2LuQZu7Vff5FK-qlTcFCz9yzY5yh9bHE&center=<?php echo $transient['longitude'] ?>,<?php echo $transient['latitude'] ?>&zoom=18&maptype=roadmap"
                                        frameborder="0"
                                        style="min-width: 100%; min-height: 300px"></iframe>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <div class="collapsed card-link" data-toggle="collapse" href="#col5">
                            Reviews
                        </div>
                    </div>
                    <div id="col5" class="collapse" data-parent="#accordion">
                        <div class="card-body actionBox">
                            <ul class="commentList">
                                <?php foreach ($comments as $comment){?>
                                <li>
                                    <div class="commenterImage">
                                        <img src="<?php if ($comment['profile_img'] != '') {
                                            echo "data:image;base64," . base64_encode($comment['profile_img']);
                                        } else {
                                            echo "../images/default-profile.png";
                                        } ?>" style="max-height: 100px;" class="rounded-circle">
                                    </div>
                                    <div class="commentText">
                                        <p class=""><?php echo htmlentities($comment['message'])?></p> <span
                                                class="date sub-text">on <?php
                                            $date = date_create($comment['date']);
                                            echo date_format($date, 'jS F Y');
                                            ?></span>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>

                            <form role="form" method="post" action="addreview.php">
                                <div class="rating">
                                    <label>
                                        <input type="radio" name="rating" value="5" title="5 stars"> 5
                                    </label>
                                    <label>
                                        <input type="radio" name="rating" value="4" title="4 stars"> 4
                                    </label>
                                    <label>
                                        <input type="radio" name="rating" value="3" title="3 stars"> 3
                                    </label>
                                    <label>
                                        <input type="radio" name="rating" value="2" title="2 stars"> 2
                                    </label>
                                    <label>
                                        <input type="radio" name="rating" value="1" title="1 star"> 1
                                    </label>
                                </div>
                                <textarea class="form-control" placeholder="Write your comments here..." rows="4"
                                          cols="50" name="comment"></textarea>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-default" value="Comment">
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
                                <img src="<?php if ($transient['provider-img'] != '') {
                                    echo "data:image;base64," . base64_encode($transient['provider-img']);
                                } else {
                                    echo "../images/default-profile.png";
                                } ?>" style="max-height: 100px;" class="rounded-circle">
                            </div>
                            <div class="row justify-content-center">
                                <h4><?php echo $f_name . ' ' . $l_name ?></h4>
                            </div>
                            <div class="row justify-content-center">
                                <p><?php
                                    $provider_address = explode(' ', $provider_address);
                                    for ($x = count($provider_address) - 1; $x != 0; $x--) {
                                        echo $provider_address[$x] . ', ';
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

    $('.rating input').change(function () {
        var $radio = $(this);
        $('.rating .selected').removeClass('selected');
        $radio.closest('label').addClass('selected');
    });
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATtlQ7diHJXSSmEicr81GWSh-d-X4R5NE&callback=initMap">
</script>
</html>


