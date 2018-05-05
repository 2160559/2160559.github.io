<!DOCTYPE html>
<html>
<?php require_once ('includes/head.inc.php')?>
<body>
<?php include_once ('includes/nav.inc.php')?>
<div class="container" style="margin-top: 50px">    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Send Message</h1></div>
                <div class="card-body">                                                                 
                    <form name="registration" action="" method="post">
                        
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6">
                                <input class="form-control" type="email" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        
                       <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right" for="message">Message:</label>
                           <div class="col-md-6">
                                <textarea class="form-control" rows="5" id="message"></textarea>
                           </div>
                        </div>                                          
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <input class="btn btn-sm" type="submit" name="submit" value="Clear" />
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input class="btn-info btn" type="submit" name="submit" value="Send" />
                            </div>
                        </div>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>