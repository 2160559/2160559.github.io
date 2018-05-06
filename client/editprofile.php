<!DOCTYPE html>
<html>
<?php session_start(); require_once ('includes/head.inc.php')?>
<body>
<?php include_once ('includes/nav.inc.php')?>
<div class="container" style="margin-top: 50px">    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Edit Profile</h1></div>
                <div class="card-body">
                                       
                    <form action="uploadfile.php" method="POST" enctype="multipart/form-data" target="_blank">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Add/Change<br/>Profile Photo</label>
                            <div class="col-md-6">
                                <p><input type="file" class="form-control-file" name="file"></p>
                                <p><input class="btn btn-secondary" type="submit" value="Upload"></p>                           
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Remove<br/>Profile Photo</label>
                            <div class="col-md-6">                                
                                <input class="btn btn-outline-danger btn-sm" type="submit" name="submit" value="Remove Photo" />                            
                            </div>
                        </div>
                    </form>                 
                    
                    <form name="registration" action="" method="post">
                        
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">First Name</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="f_name" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Last Name</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="l_name" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Birthdate</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" name="birthdate" required>
                                <p><input type="checkbox" name="" value="hide"> Hide Birthday</p>
                            </div>                           
                        </div>                                             
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Phone Number</label>
                            <div class="col-md-6">
                                <input class="form-control" type="tel" name="phone" placeholder="09090909090" required>
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input class="btn-info btn" type="submit" name="submit" value="Save Changes" />
                            </div>
                        </div>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
</div>
    <?php require_once ('includes/footer.inc.php')?>
</body>
</html>