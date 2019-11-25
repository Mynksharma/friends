<?php 
require 'commonfb.php';$us=$_SESSION['id'];
$sql="select CONCAT(users.first,' ',users.last) as name,users.id from users,chats where chats.userid=users.id and chats.friend_id='$us' and chats.status ='0'";
$result= mysqli_query ($con,$sql);
$json_array=array();
while($row=mysqli_fetch_assoc($result)){
    $json_array[]=$row;
    }
     print_r(json_encode($json_array));?>
