<!DOCTYPE html>
<html>
<?php session_start(); require_once('includes/head.inc.php') ?>
<body>
<?php include_once('includes/nav.inc.php') ?>
<!-- Main -->
<div class="container" style="margin-top: 25px;">
    <div class="container col-md-8" id="main">
        <div class="row">
            <div class="col-sm-12 col-md-6 mainbox alert alert-secondary alert-dismissible fade show">
                <p>Box 1</p>
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <div class="col-sm-12 col-md-6 mainbox alert alert-secondary alert-dismissible fade show">
                <p>Box 2</p>
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>         
            <div class="clearfix visible-md-block"></div>          
            <div class="col-sm-12 col-md-6 mainbox alert alert-secondary alert-dismissible fade show">
                <p>Box 3</p>
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <div class="col-sm-12 col-md-6 mainbox alert alert-secondary alert-dismissible fade show">
                <p>Box 4</p>
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>           
            <div class="clearfix visible-md-block"></div>            
            <div class="col-sm-12 col-md-6 mainbox alert alert-secondary alert-dismissible fade show">
                <p>Box 5</p>
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
          <div class="col-sm-12 col-md-6 mainbox alert alert-secondary alert-dismissible fade show">
                <p>Box 6</p>
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        </div>
    </div>
</div>

<?php include_once ('includes/footer.inc.php')?>
</body>
</html>


