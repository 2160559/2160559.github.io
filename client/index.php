<?php
session_start();
<<<<<<< HEAD
if (isset($_SESSION['id'])){
=======
if (!isset($_SESSION['username'])){
>>>>>>> abb5b867cc252fd8119f4acdf2384eb09e29ec59
    include_once ('homepage.php');
}else{
    include_once ('landingpage.php');
}