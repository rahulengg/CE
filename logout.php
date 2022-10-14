

<?php
session_start();
unset($_SESSION["login_username"]);
if(session_destroy())
{
header("Location: index.php");
}
?>