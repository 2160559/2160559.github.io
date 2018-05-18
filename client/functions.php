
<?php
function add_user()
{
    require_once('User.php');
    $username = stripslashes($_REQUEST['username']);
    $firstname = stripslashes($_REQUEST['f_name']);
    $lastname = stripslashes($_REQUEST['l_name']);
    $email = stripslashes($_REQUEST['email']);
    $password = stripslashes($_REQUEST['password']);
    $birthdate = $_REQUEST['birthdate'];
    $phone = stripslashes($_REQUEST['phone']);
    //escapes special characters in a string

    return $current_user = new User(null, $username, $firstname, $lastname, 'customer',
        $email, $password, $birthdate, null, $phone);
}

function add_user_to_database($user)
{
    include_once('includes/db.inc.php');
    $username = mysqli_real_escape_string($con, $user->getUsername());
    $firstname = mysqli_real_escape_string($con, $user->getFirstName());
    $lastname = mysqli_real_escape_string($con, $user->getLastName());
    $email = mysqli_real_escape_string($con, $user->getEmailAdd());
    $password = mysqli_real_escape_string($con, $user->getPassword());
    $birthdate = mysqli_real_escape_string($con, $user->getBirthDate());
    $phone = mysqli_real_escape_string($con, $user->getPhoneNumber());
    $query = "INSERT into `users` (username, pass, email_add,f_name, l_name, birthdate, acc_type, phone_number)VALUES 
        ('$username', '" . md5($password) . "', '$email','$firstname','$lastname', '$birthdate', 'customer', '$phone')";
    echo $query;
    return mysqli_query($con, $query);
}

function connect_to_database()
{
    return mysqli_connect("localhost", "root", "", "initial") or die("Connection failed");
}

function get_user_from_database()
{
    include_once('includes/db.inc.php');
    // removes backslashes
    $email = stripslashes($_REQUEST['email']);
    //escapes special characters in a string
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    //Checking is user existing in the database or not
    $query = "SELECT * FROM `users` WHERE email_add='$email' and pass='" . md5($password) . "'";
    return mysqli_query($con, $query) or die("an error occurred");
}

function get_usernames()
{
    $con = mysqli_connect("localhost", "root", "", "initial") or die("Connection failed");
    $query = "SELECT username FROM users";
    $result = mysqli_query($con, $query) or die("an error occurred");
    while ($row = mysqli_fetch_assoc($result)) {
        $json[] = $row;
    }
    //print_r($json[0]);
    return json_encode($json);
}
