<?php 
require 'commonfb.php';
$postid=$_GET['postid'];
$sql="select CONCAT(users.first,' ',users.last)as name,postslikes.comment,postslikes.likes from postslikes,users where postslikes.user=users.id and postslikes.posts='$postid' and (postslikes.likes IS NOT NULL or postslikes.comment IS NOT NULL)";
$result=mysqli_query($con,$sql);$json_array=array();
while($row=mysqli_fetch_assoc($result)){
    $json_array[]=$row;
    }
     print_r(json_encode($json_array));?>