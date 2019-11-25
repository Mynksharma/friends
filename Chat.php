<?php
require 'commonfb.php';
$user=$_SESSION['id'];
$friendid=$_GET['id'];
$msg=$_GET['msg'];
$sql="insert into chats(userid,friend_id,message,time,status) values('$user','$friendid','$msg',CURRENT_TIMESTAMP,0)";

if(mysqli_query($con,$sql)){
    echo "inserted";
}
else{echo "problem is :".mysqli_error($con);}
?>
