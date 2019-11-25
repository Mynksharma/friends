<?php
require 'commonfb.php';$user=$_SESSION['id'];
$sql="Delete from online where online.userid='$user'"; mysqli_query($con,$sql);
session_unset();
session_destroy();
header("Location:fb.php");
?>