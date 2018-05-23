<?php
$current_user = $_SESSION['user'];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm  mb-4">
    <a class="navbar-brand " href="index.php"><img src="../images/logo%20-%20Copy.png" height="35"
                                                   class="d-inline-block align-top" alt="ABANG"/></a>
    <div class="collapse navbar-collapse" id="navb">
        <div class="mr-auto">
            <form class="form-inline my-2 my-lg-0" method="post">
                <input class="form-control col-form-label-sm mr-sm-2" type="search" placeholder="Search" name="search">
                <button class="btn btn-sm btn-outline-info my-2 my-sm-0" type="submit" name="submit">Search</button>
            </form>
        </div>
        <div class="collapse navbar-collapse" id="navb">
            <div class="mr-auto">
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://provider.abang.com/register">Become a Host</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../favorites.php">Favorites</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"
                       style="color:white;">
                        <img src="<?php if ($current_user['profile_img'] !='') {
                            echo "data:image;base64," . base64_encode($current_user['profile_img']);
                        }else{
                            echo "../images/default-profile.png";
                        } ?>"
                             class="rounded-circle" style="min-height: 35px;">
                        <?php echo $current_user['username'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="../profile.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
