<?php
include 'db.inc.php';
if (isset($_POST['user_name'])) {
    if ($stmt = $mysqli->prepare("SELECT username FROM `users` where username = ?")) {
        $stmt->bind_param('s', $_POST['user_name']);
        $stmt->execute();
        $stmt->bind_result($username);
        $usernames = [];
        while ($stmt->fetch()) {
            $usernames[] = $username;
        }
        if (count($usernames) > 0) {
            echo "Username Already Exists";
        } else {
            echo "&#10003;";
        }
    }
    exit();
}

if (isset($_POST['user_email'])) {
    if ($stmt = $mysqli->prepare("SELECT email_add FROM `users` where email_add = ?")) {
        $stmt->bind_param('s', $_POST['user_email']);
        $stmt->execute();
        $stmt->bind_result($email);
        $emails = [];
        while ($stmt->fetch()) {
            $emails[] = $email;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } elseif (count($emails) > 0) {
            echo "Email Already Exists";
        } else {
            echo "&#10003;";
        }
    }
    exit();
}
if (isset($_POST['email_add'])) {
    if ($stmt = $mysqli->prepare("SELECT email_add FROM `users` where email_add = ?")) {
        $stmt->bind_param('s', $_POST['email_add']);
        $stmt->execute();
        $stmt->bind_result($email);
        $emails = [];
        while ($stmt->fetch()) {
            $emails[] = $email;
        }
if (count($emails) < 0) {
            echo "Email Does Not Exist";
        } else {
            echo "&#10003;";
        }
    }
    exit();
}