<?php 
require 'commonfb.php';
$post=$_POST['status'];$id=$_SESSION['id'];
$sql="insert into posts(userid,status,update_date) values('$id','$post',NOW());";
mysqli_query($con,$sql);
header('location:main.php');?>


