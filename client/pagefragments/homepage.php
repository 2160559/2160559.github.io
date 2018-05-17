<!DOCTYPE html>
<html>
<?php
include 'pagefragments/head.html';
include 'includes/db.inc.php';
?>

<body>
<?php
include 'pagefragments/nav.inc.php';
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
?>
<!-- Main -->
<div class="container" style="margin-top: 25px;">
    <div class="row p-3">
        <div class="col-12 col-md-6 mb-4 col-lg-4 filterarea">
            <div class="profile-usertitle-name">Price Range</div>
            <section class="range-slider">
                <span class="rangeValues  profile-usertitle-username"></span>
                <input value="500" min="500" max="50000" step="500" type="range">
                <input value="50000" min="500" max="50000" step="500" type="range">
            </section>
        </div>
        <div class="col-12 col-md-6 mb-4 col-lg-4 filterarea">
            <div class="profile-usertitle-name">Number of Guests</div>
            <section class="range-slider">
                <span class="rangeValues  profile-usertitle-username"></span>
                <input value="1" min="1" max="30" step="1" type="range">
                <input value="30" min="1" max="30" step="1" type="range">
            </section>
        </div>
        <div class="col-12 col-md-6 mb-4 col-lg-4 filterarea">

        </div>
    </div>
    <section class="cid-qRL1tBino6">
        <?php
        echo '<div class="row p-3">';
        foreach ($houses as $house) {
            echo "
            <form action='transient.php' method='post' class='col-12 col-md-6 mb-4 col-lg-4'>
                <input type='text' class='d-none' value='$house[0]' name='house_id'>
                <button type='submit' style='height: inherit; width: inherit;' class='btn'>
                    <div class='card flip-card  align-center'>
                        <div class='card-front card_cont'>
                            <img src='data:image;base64,". base64_encode($house['3']) . "'>
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
        <ul class="pagination float-right">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </section>

</div>
<script>
    function getVals() {
        // Get slider values
        var parent = this.parentNode;
        var slides = parent.getElementsByTagName("input");
        var slide1 = parseFloat(slides[0].value);
        var slide2 = parseFloat(slides[1].value);
        // Neither slider will clip the other, so make sure we determine which is larger
        if (slide1 > slide2) {
            var tmp = slide2;
            slide2 = slide1;
            slide1 = tmp;
        }

        var displayElement = parent.getElementsByClassName("rangeValues")[0];
        displayElement.innerHTML = slide1 + " - " + slide2;

    }

    window.onload = function () {
        // Initialize Sliders
        var sliderSections = document.getElementsByClassName("range-slider");
        for (var x = 0; x < sliderSections.length; x++) {
            var sliders = sliderSections[x].getElementsByTagName("input");
            for (var y = 0; y < sliders.length; y++) {
                if (sliders[y].type === "range") {
                    sliders[y].oninput = getVals;
                    // Manually trigger event first time to display values
                    sliders[y].oninput();
                }
            }
        }
    }

</script>

<?php include_once('pagefragments/footer.html') ?>
</body>

</html>
