<?php
session_start();
include("config.php");
include("usersession.php");
?>

<?php 

if (isset($_POST['submit'])){

echo $fname=$_POST['firstname'];
echo  $uname=$_POST['lastname'];
echo $phone=$_POST['phone'];
echo $email=$_POST['Email'];
echo  $country=$_POST['country'];
echo $city=$_POST['city'];
echo $address=$_POST['address'];
echo  $pcode=$_POST['pcode'];
$id=$_POST['ID'];

echo $query="update customer  set FullName = '$fname', UserName = '$uname', Phone = '$phone',Email = '$email', Country = '$country', City = '$city', Adress = '$address', PostalCode = '$pcode' where Cust_Id = $id";
$rows=mysqli_query($mysqli,$query);
echo "succes full updated ".$rows;
mysqli_close($con);
header("location: profile.php?msg=succes full update one record");
exit();
}

?>

