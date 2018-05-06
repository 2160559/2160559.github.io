<?php
include_once("includes/db.inc.php");
if(isset($_POST['username']) && $_POST['username'] != '')
    {
		$response = array();
		$username = mysqli_real_escape_string($conn,$_POST['username']);
        $sql  = "select username from users where users.username='".$username."'";
        $res    = mysqli_query($conn, $sql);
        $count  = mysqli_num_rows($res);
        if($count > 0)
		{
			$response['status'] = false;
			$response['msg'] = 'Username already exists.';
		}
		else if(strlen($username) < 6 || strlen($username) > 15){
			$response['status'] = false;
			$response['msg'] = 'Username must be 6 to 15 characters';
		}
		else if (!preg_match("/^[a-zA-Z1-9]+$/", $username))
		{
			$response['status'] = false;
			$response['msg'] = 'Use alphanumeric characters only.';
		}
		else
		{
			$response['status'] = true;
			$response['msg'] = 'Username is available.';
		}
		 echo json_encode($response);
    }
?>

