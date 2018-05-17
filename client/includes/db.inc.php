<?php
define('host', '192.168.254.112');
define('user', 'root');
define('password', '');
define('database', 'transient');
$mysqli = new mysqli(host, user, password, database);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
