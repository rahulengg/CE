<?php 

//include config.php to connect to the database
	include("config.php"); 
	
	//start session
    session_start();
{
		// Define $myusername and $mypassword
	$a=$_POST['uname'];
	$b=$_POST['pwd'];
	
	// To protect MySQL injection
	$a= mysqli_real_escape_string( $mysqli,$a);
	$b = mysqli_real_escape_string( $mysqli, $b);

    $fetch=mysqli_query( $mysqli, "select Cust_Id from customer where Email='$a' and Password= '$b'");
    $count=mysqli_num_rows($fetch);
    if($count!="")
    {
    $_SESSION['login_username']=$a;
	 header("location: index.php");
    }
    else
    {
	   header('Location: Sign In.php');
	}

}
?>
