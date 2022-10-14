<?php 

//include config.php to connect to the database
	include("config.php"); 

include("usersession.php");

	//start session
    session_start();
{
		// Define $myusername and $mypassword
	$uname=$_POST['auname'];
	$pwd=$_POST['apwd'];
	
	// To protect MySQL injection
	$uname= mysqli_real_escape_string( $mysqli,$uname);
	$pwd = mysqli_real_escape_string( $mysqli, $pwd);

    $fetch=mysqli_query( $mysqli, "select Employee_ID from employee where Username='$uname' and Password = '$pwd'");
    $count=mysqli_num_rows($fetch);
    if($count!="")
    {
    $_SESSION['login_username']=$uname;
	 header("location: Admin/index.php");
    }
    else
    {
	   header('Location: Sign In.php');
	}

}
?>
