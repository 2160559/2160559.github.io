<!DOCTYPE html>
<html>
<?php
include 'pagefragments/head.html';
include 'includes/db.inc.php';
?>

<body>
<?php
include 'pagefragments/nav.inc.php';
$houses = [];
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'Rating') {
        $query = "SELECT  house.id, name,address, image FROM house join `house-images` on cover_image = `house-images`.id left join reviews on house.id = reviews.`house-id` group by id order by sum(rating) desc";
    } elseif ($_GET['sort'] == 'Price-desc') {
        $query = "SELECT  house.id, name,address, image FROM house join `house-images` on cover_image = `house-images`.id order by price desc;";
    } elseif ($_GET['sort'] == 'Price-asc') {
        $query = "SELECT  house.id, name,address, image FROM house join `house-images` on cover_image = `house-images`.id order by price asc;";
    }
    if ($stmt = $mysqli->prepare($query)) {
        $houses = [];
        $stmt->execute();
        $stmt->bind_result($id, $name, $address, $img);
        while ($stmt->fetch()) {
            $houses[] = array($id, $name, $address, $img);
        }
        $stmt->close();
    }
    $mysqli->close();
} elseif (isset($_GET['filter'])) {
    if ($_GET['filter'] == 'PriceRange') {
        $query = "SELECT  house.id, name,address, image FROM house join `house-images` on cover_image = `house-images`.id where price >= ? and price <=?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param('ii', $_GET['min'], $_GET['max']);
            $stmt->execute();
            $stmt->bind_result($id, $name, $address, $img);
            while ($stmt->fetch()) {
                $houses[] = array($id, $name, $address, $img);
            }
            $stmt->close();
        }
        $mysqli->close();
    } elseif ($_GET['filter'] == 'Address') {
        $addr = "%".$_GET['address']."%";
        $query = "SELECT  house.id, name,address, image FROM house join `house-images` on cover_image = `house-images`.id where address like ?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param('s', $addr);
            $stmt->execute();
            $stmt->bind_result($id, $name, $address, $img);
            while ($stmt->fetch()) {
                $houses[] = array($id, $name, $address, $img);
            }
            $stmt->close();
        }
        $mysqli->close();
    } elseif ($_GET['filter'] == 'NumberOfRooms') {
        $query = "SELECT  house.id, name,address, image FROM house join `house-images` on cover_image = `house-images`.id where no_room >= ? and no_room <=?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param('ii', $_GET['min-room'], $_GET['max-room']);
            $stmt->execute();
            $stmt->bind_result($id, $name, $address, $img);
            while ($stmt->fetch()) {
                $houses[] = array($id, $name, $address, $img);
            }
            $stmt->close();
        }
    }

} else {
    if ($stmt = $mysqli->prepare('SELECT house.id, name,address, image FROM house join `house-images` on cover_image = `house-images`.id;')) {
        $houses = [];
        $stmt->execute();
        $stmt->bind_result($id, $name, $address, $img);
        while ($stmt->fetch()) {
            $houses[] = array($id, $name, $address, $img);
        }
        $stmt->close();
    }
    $mysqli->close();
}
?>
<!-- Main -->
<div class="container" style="margin-top: 25px;">
    <div class="row">
        <div class="col-6 p-3">
            <form method="get">
                <h2>Sort by:</h2>
                <div class="row">
                    <div class="form-group col-10">
                        <select name="sort" class="form-control">
                            <option value="Rating">Rating (Highest to Lowest)</option>
                            <option value="Price-desc">Price (Highest to Lowest)</option>
                            <option value="Price-asc">Price (Lowest to Highest)</option>
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <input type="submit" value="Sort" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6 p-3">
            <h2>Filter by:</h2>
            <form method="get">
                <div class="row">
                    <div class="form-group col-10">
                        <div>
                            <select name="filter" class="form-control" id="filter">
                                <option value="PriceRange">Price Range</option>
                                <option value="Address">Address</option>
                                <option value="NumberOfRooms">Number of Rooms</option>
                            </select>
                        </div>
                        <div class="row p-3" id="price-range">
                            <label class="col">Price Range:</label>
                            <input class="col form-control" type="number" name="min" min="100" placeholder="min">
                            <input class="col form-control" type="number" name="max" placeholder="max">
                        </div>
                        <div class="row p-3" id="address">
                            <label class="col-4">Address:</label>
                            <input type="text" class="col-8 form-control" name="address">
                        </div>
                        <div class="row p-3" id="numberofrooms">
                            <label class="col-8">Number of Rooms:</label>
                            <input class="col form-control" type="number" name="min-room" placeholder="min">
                            <input class="col form-control" type="number" name="max-room" placeholder="max">
                        </div>
                        <div>
                            <input type="submit" value="Filter" class="btn btn-primary">
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <section class="cid-qRL1tBino6">
        <?php
        echo '<div class="row p-3">';
        foreach ($houses as $house) {
            echo "
            <form action='transient.php' method='get' class='col-12 col-md-6 mb-4 col-lg-4'>
                <input type='text' class='d-none' value='$house[0]' name='house_id'>
                <button type='submit' style='height: inherit; width: inherit;' class='btn'>
                    <div class='card flip-card  align-center'>
                        <div class='card-front card_cont'>
                            <img src='data:image;base64," . base64_encode($house[3]) . "'>
                        </div>
                        <div class='card_back card_cont'>
                            <p class='mbr-text mbr-fonts-style display-7'>
                            <h4>$house[1]</h4>   
                            </p>
                            <hr>
                            <p class='mbr-text mbr-fonts-style display-7'>
                                $house[2]
                            </p>
                        </div>
                    </div>
                </button>
            </form>";
        }
        echo '</div>';
        ?>
        <!--
        <ul class="pagination float-right">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>-->
    </section>

</div>
<?php include_once('pagefragments/footer.html') ?>
</body>
<script>
    $(function() {
        $('#address').hide();
        $('#numberofrooms').hide();
        $('#filter').change(function(){
            if($('#filter').val() == 'PriceRange') {
                $('#price-range').show();
                $('#address').hide();
                $('#numberofrooms').hide();
            } else if (($('#filter').val() == 'Address')) {
                $('#address').show();
                $('#price-range').hide();
                $('#numberofrooms').hide();
            } else if (($('#filter').val() == 'NumberOfRooms')) {
                $('#address').hide();
                $('#numberofrooms').show();
                $('#price-range').hide();
            }
        });
    });
</script>

</html>
