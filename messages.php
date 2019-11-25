<?php 
require 'commonfb.php';$us=$_SESSION['id'];
$userid=$_GET['id'];
$sql="Select chats.message,chats.userid,chats.friend_id from chats where (chats.userid='$us' and chats.friend_id='$userid') or (chats.userid='$userid' and chats.friend_id='$us') order by chats.time";
$result=mysqli_query($con,$sql);$json_array=array();
while($row=mysqli_fetch_assoc($result)){
    $json_array[]=$row;
    }
     print_r(json_encode($json_array));?>
