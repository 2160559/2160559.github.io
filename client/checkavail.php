<!DOCTYPE html>
<html>
<?php session_start();
require_once('includes/head.inc.php') ?>
<body>
<?php
include_once('includes/nav.inc.php');
include_once('functions.php');
include_once('User.php');
include_once('getUser.php');
include_once('includes/db.inc.php');
?>
<div class="container" >

    <?php
    if (isset($_REQUEST['username'])) {
        $current_user->setUsername($_REQUEST['username']);
        $current_user->setFirstName($_REQUEST['f_name']);
        $current_user->setLastName($_REQUEST['l_name']);
        $current_user->setBirthDate($_REQUEST['birthdate']);
        $current_user->setPhoneNumber($_REQUEST['phone']);
        $query = "UPDATE `users` SET `username`='" . $current_user->getUsername() . "',`f_name`='" . $current_user->getFirstName() . "',
      `l_name`='" . $current_user->getLastName() . "',`birthdate`='" . $current_user->getBirthDate() . "',
      `phone_number`='" . $current_user->getPhoneNumber() . "' WHERE `id` = '" . $current_user->getUserId() . "'";
        $result = mysqli_query($con, $query) or die("an error occurred");
    } ?>
    <div class="row m-4 pb-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Check Availability</h1></div>
                <div class="card-body">

                    <form name="registration" action="" method="post">

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Check-in</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" name="checkin" value="<?php
                                echo $current_user->getBirthDate() ?>" required>
                            </div>
                        </div>
                      <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Check-out</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" name="checkout" value="<?php
                                echo $current_user->getBirthDate() ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="sel1">Guest</label>
                            <div class="col-md-6">
                                <div class="dropdown">
                                  <select class="form-control" id="sel1">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                  <option>13</option>
                                  <option>14</option>
                                  <option>15</option>
                                  <option>16</option>
                                  <option>17</option>
                                  <option>18</option>
                                  <option>19</option>
                                  <option>20</option>
                                  <option>21</option>
                                  <option>22</option>
                                  <option>23</option>
                                  <option>24</option>
                                  <option>25</option>
                                  <option>26</option>
                                  <option>27</option>
                                  <option>28</option>
                                  <option>29</option>
                                  <option>30</option>
                                </select>
                              </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input class="btn-primary btn" type="submit" name="submit"  value="Check"/>
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