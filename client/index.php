<?php
session_start();
if (isset($_SESSION['id'])){
    include_once('pagefragments/homepage.php');
}else{
    include_once('pagefragments/landingpage.php');
}