<!DOCTYPE html>
<html>
<<<<<<< HEAD
<?php
    require_once ('includes/head.inc.php');
?>

	<body>
		<?php include_once ('includes/nav.inc.php')?>
		<!-- Main -->
		<div class="container" style="margin-top: 25px;">
			<section class="cid-qRL1tBino6">

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
				<div class="row p-3">
					<div class="col-12 col-md-6 mb-4 col-lg-4">
						<div class="card flip-card  align-center">
							<div class="card-front card_cont">
								<img src="../images/Jonathan-Javier.jpg" alt="Mobirise">
							</div>
							<div class="card_back card_cont">
								<h4 class="card-title display-5 py-2 mbr-fonts-style">
									Over 400 Amazing Blocks
								</h4>
								<p class="mbr-text mbr-fonts-style display-7">
									Mobirise offers several themes that include sliders, galleries, article blocks, counters, accordions, video and many more.
								</p>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-6 mb-4 col-lg-4">

						<div class="card flip-card  align-center">
							<div class="card-front card_cont">
								<img src="../images/Jonathan-Javier.jpg" alt="Mobirise">
							</div>
							<div class="card_back card_cont">
								<h4 class="card-title py-2 mbr-fonts-style display-5">
									Easy and Simple to Use
								</h4>
								<p class="mbr-text mbr-fonts-style display-7">
									Drop the blocks into the page, edit content inline and publish - no technical skills required.
								</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 mb-4 col-lg-4">

						<div class="card flip-card  align-center">
							<div class="card-front card_cont">
								<img src="../images/Jonathan-Javier.jpg" alt="Mobirise">
							</div>
							<div class="card_back card_cont">
								<h4 class="card-title py-2 mbr-fonts-style display-5">
									Easy and Simple to Use
								</h4>
								<p class="mbr-text mbr-fonts-style display-7">
									Drop the blocks into the page, edit content inline and publish - no technical skills required.
								</p>
							</div>
						</div>
					</div>


				</div>
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
=======
  <?php
  require_once ('includes/head.inc.php');
  ?>
  <body>
    <?php include_once ('includes/nav.inc.php')?>
    <!-- Main -->
    <div class="container" style="margin-top: 25px;">
      <section class="cid-qRL1tBino6">   

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
        <div class="row p-3">
          <div class="col-12 col-md-6 mb-4 col-lg-4">
            <div class="card flip-card  align-center">
              <div class="card-front card_cont">
                <img src="../images/Jonathan-Javier.jpg" alt="Mobirise">
              </div>
              <a href="../transient.php"><div class="card_back card_cont">
                <h4 class="card-title py-2 mbr-fonts-style display-5">
                  Easy and Simple to Use
                </h4>
                <p class="mbr-text mbr-fonts-style display-7">
                  Drop the blocks into the page, edit content inline and publish - no technical skills required.
                </p>                
                </div>
              </a>
            </div>
          </div>

          <div class="col-12 col-md-6 mb-4 col-lg-4">
            <div class="card flip-card  align-center">
              <div class="card-front card_cont">
                <img src="../images/Jonathan-Javier.jpg" alt="Mobirise">
              </div>
              <a href="../transient.php"><div class="card_back card_cont">
                <h4 class="card-title py-2 mbr-fonts-style display-5">
                  Easy and Simple to Use
                </h4>
                <p class="mbr-text mbr-fonts-style display-7">
                  Drop the blocks into the page, edit content inline and publish - no technical skills required.
                </p>                
                </div>
              </a>
            </div>
          </div>

          <div class="col-12 col-md-6 mb-4 col-lg-4">
            <div class="card flip-card  align-center">
              <div class="card-front card_cont">
                <img src="../images/Jonathan-Javier.jpg" alt="Mobirise">
              </div>
              <a href="../transient.php"><div class="card_back card_cont">
                <h4 class="card-title py-2 mbr-fonts-style display-5">
                  Easy and Simple to Use
                </h4>
                <p class="mbr-text mbr-fonts-style display-7">
                  Drop the blocks into the page, edit content inline and publish - no technical skills required.
                </p>                
                </div>
              </a>
            </div>
          </div>
          
        </div>
        <ul class="pagination justify-content-center">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul> </section>

    </div>
    <script>function getVals(){
        // Get slider values
        var parent = this.parentNode;
        var slides = parent.getElementsByTagName("input");
        var slide1 = parseFloat( slides[0].value );
        var slide2 = parseFloat( slides[1].value );
        // Neither slider will clip the other, so make sure we determine which is larger
        if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }

        var displayElement = parent.getElementsByClassName("rangeValues")[0];
        displayElement.innerHTML =  slide1 + " - " + slide2 ;

      }

      window.onload = function(){
        // Initialize Sliders
        var sliderSections = document.getElementsByClassName("range-slider");
        for( var x = 0; x < sliderSections.length; x++ ){
          var sliders = sliderSections[x].getElementsByTagName("input");
          for( var y = 0; y < sliders.length; y++ ){
            if( sliders[y].type ==="range" ){
              sliders[y].oninput = getVals;
              // Manually trigger event first time to display values
              sliders[y].oninput();
            }
          }
        }
      }</script>

    <?php include_once ('includes/footer.inc.php')?>
  </body>
</html>
>>>>>>> 31eee3dc2387c9035b5b840c9a891a4192f90daa

				var displayElement = parent.getElementsByClassName("rangeValues")[0];
				displayElement.innerHTML = slide1 + " - " + slide2;

			}

			window.onload = function() {
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

		<?php include_once ('includes/footer.inc.php')?>
	</body>

</html>
