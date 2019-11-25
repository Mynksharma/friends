<?php 
require 'commonfb.php';
$sql="select online.userid,CONCAT(users.first,' ',users.last)as name from online,friends,users where online.userid=users.id and (select if(friends.friend_id=".$_SESSION['id'].",friends.fid,friends.friend_id))=users.id and friends.request='accept' and (friends.fid=".$_SESSION['id']." or friends.friend_id=".$_SESSION['id'].")";
$result=mysqli_query($con,$sql);$json_array=array();
while($row=mysqli_fetch_assoc($result)){
    $json_array[]=$row;
    }
     print_r(json_encode($json_array));?>