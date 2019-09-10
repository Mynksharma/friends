<?php 
require 'commonfb.php';$user=20;
$postid=$_GET['id'];
$comm=$_GET['comm'];

if($comm=="delete"){
    $sql="Delete from postslikes where posts=".$postid." and user=".$user;
    mysqli_query ($con,$sql);
    $sql="select count(likes),count(comment) from postslikes where posts=".$postid;
   $result= mysqli_query ($con,$sql);
    $res=mysqli_fetch_assoc($result);
    print_r(json_encode($res));
}
else if($comm=="insert"){
    $sql="insert into postslikes(posts,user,likes,comment) values(".$postid.",".$user.",'1','')";
    mysqli_query ($con,$sql);
    $sql="select count(likes),count(comment) from postslikes where posts=".$postid;
   $result= mysqli_query ($con,$sql);
    $res=mysqli_fetch_assoc($result);
    print_r(json_encode($res));
}
?>