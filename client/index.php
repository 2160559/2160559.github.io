<?php
session_start();
if (isset($_SESSION['username'])){
    include_once ('homepage.php');
}else{
    include_once ('landingpage.php');
}