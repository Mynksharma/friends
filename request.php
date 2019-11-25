<?php 
require 'commonfb.php';$user=$_SESSION['id'];
$id=$_GET['id'];
$comm=$_GET['comm'];
if($comm=="delete"){
    $sql="Delete from friends where fid=".$user." and friend_id=".$id." and request='waiting'";
if(mysqli_query ($con,$sql)){ print_r("Add Friend");}else{die(mysqli_error($con));}
   
}
else if($comm=="add"){
    $sql="insert into friends(fid,friend_id,request) values(".$user.",".$id.",'waiting')";
    mysqli_query ($con,$sql);
    print_r("Request Sent");
}
?>