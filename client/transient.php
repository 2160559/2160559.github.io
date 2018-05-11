<!DOCTYPE html>
<html>
  <?php require_once ('includes/head.inc.php')?>
  <body>
    <?php include_once ('includes/nav.inc.php')?>
    <!-- Main -->
    <div class="container">
      <div class="row">
        <div class="col-lg jumbotron-fluid mainbox img-fluid" style="height:20em; border-style:solid;">   
        </div>
      </div>
      <div class ="row">      
          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            
            <div class="btn-grp" role="group" aria-label="Second group">
              <div class="btn-group-toggle" data-toggle="buttons">
                <input class="btn btn-outline-info active btn-lg btn-block" type="submit" name="submit" value="View Later">
              </div>
            </div>
            
            <div class="btn-grp" role="group" aria-label="Third group">
              <input class="btn-dark btn btn-lg btn-block" type="submit" name="submit" value="Check Availability" />
            </div>
            
            <div class="btn-grp" role="group" aria-label="Fourth group">
              <input class="btn-dark btn btn-lg btn-block" type="submit" name="submit" value="Book Now" />
            </div>
                        
            <div class="btn-grp" role="group" aria-label="First group">
              <input class="btn-dark btn btn-lg btn-block" type="button" data-toggle="modal" data-target="#myModal" name="submit" value="View Photos" />
            </div>
          </div>
        </div>
  
      <br>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1>Transient Name</h1> 
          <p>Short Desc..</p> 
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
                  Lorem ipsum..
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
                  Lorem ipsum..
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
                  Lorem ipsum..
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
                  Lorem ipsum..
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
                        <img src="images/EagleNewsPh.jpg" />
                      </div>
                      <div class="commentText">
                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>
                      </div>
                    </li>
                    <li>
                      <div class="commenterImage">
                        <img src="images/baguio-city.jpg" />
                      </div>
                      <div class="commentText">
                        <p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>
                      </div>
                    </li>
                    <li>
                      <div class="commenterImage">
                        <img src="images/Jonathan-Javier.jpg" />
                      </div>
                      <div class="commentText">
                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>
                      </div>
                    </li>
                  </ul>
                  <form class="form-inline" role="form">
                    <div class="form-group">
                      <textarea class="form-control" placeholder="Write your comments here..." rows="4" cols="30"></textarea>
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
                  Lorem ipsum..
                </div>
              </div>
            </div>       
          </div>
        </div>

      </div>
      
      <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Transient Name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active img-fluid">
      <img src="images/baguio-city.jpg" alt="Los Angeles">
    </div>
    <div class="carousel-item img-fluid">
      <img class="img-fluid" src="images/EagleNewsPh.jpg" alt="Chicago">
    </div>
    <div class="carousel-item img-fluid">
      <img src="images/Jonathan-Javier.jpg" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

    </div>


    <?php include_once ('includes/footer.inc.php')?>
  </body>

</html>


