<!DOCTYPE html>
<html>
<?php
include 'pagefragments/head.html';
include 'includes/db.inc.php';
?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand " href="index.php"><img src="../images/logo%20-%20Copy.png" height="50"
                                                   class="d-inline-block align-top" alt="ABANG"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navb">
        <div class="mr-auto">

        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="registration.php">Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://provider.abang.com/register">Become a Host</a>
            </li>
        </ul>
    </div>
</nav>
<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<div class="container">
    <?php
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = stripslashes($_REQUEST['email']);
        $password = stripslashes($_REQUEST['password']);
        if ($stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `email_add` = ?")) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($id, $username, $f_name, $l_name, $email_add, $pass, $phone, $acc_type,
                $profile_img, $birthday, $status);
            $stmt->fetch();
            if ($email_add == ''){
                echo "
                <script>
                    window.alert('Email Address Not Found!');
                </script>
                ";
            }
            elseif ($status == 'enabled' || $status == 'approved') {
                if ($acc_type == 'provider') {
                    ?>
                    <form action="http://provider.abang.com/providerlogin" method="post" id="user-form">
                        <input type="text" name="email_add" value="<?php echo $email ?>">
                        <input type="text" name="password" value="<?php echo $password ?>">
                        <input type="submit" class="d-none">
                    </form>
                    <script type="text/javascript">
                        document.getElementById('user-form').submit(); // SUBMIT FORM
                    </script>
                <?php
                } else {
                if (password_verify($password, $pass)) {
                    $current_user = array('id' => $id, 'username' => $username, 'first_name' => $f_name, 'last_name' =>
                        $l_name, 'email' => $email, 'password' => $pass, 'phone' => $phone, 'acc_type' => $acc_type,
                        'profile_img' => $profile_img, 'birthdate' => $birthday, 'status' => $status);
                    session_start();
                    $_SESSION['id'] = session_create_id();
                    $_SESSION['user'] = $current_user;
                    header('Location: index.php');
                } else {
                ?>
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                         aria-labelledby="modal-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title">Error!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Invalid Username/Password
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(window).on('load', function () {
                            $('#modal').modal('show');
                        });
                    </script>
                    <?php
                }
                }
            } elseif ($status == 'pending') {
                header('Location: inactive.php');
            } else {
                header('Location: deactivated.php');
            }
            $stmt->close();
        }
        $mysqli->close();
    }
    include('pagefragments/login_page.html');
    ?>
</div>
<?php include 'pagefragments/footer.html' ?>
</body>
</html>