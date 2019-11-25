<?php 
require 'commonfb.php';$user=$_SESSION['id'];
$reqid=$_GET['id'];
$comm=$_GET['what'];

if($comm=="decline"){
    $sql="Delete from friends where fid=".$reqid." and friend_id=".$user;
}
else if($comm=="confirm"){
    $sql="update friends set request='accept' where fid=".$reqid." and friend_id=".$user;
}
mysqli_query ($con,$sql);
?>