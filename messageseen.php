<?php
require 'commonfb.php';$user=$_SESSION['id'];
$userid=$_GET['id'];
$sql="update chats set chats.status='1' where chats.friend_id='$user' and chats.userid='$userid' ";
mysqli_query($con,$sql);?>