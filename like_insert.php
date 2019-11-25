<?php 
require 'commonfb.php';$user=$_SESSION['id'];
$postid=$_GET['id'];
$comm=$_GET['comm'];

if($comm=="delete"){
    $sql="Delete from postslikes where posts=".$postid." and user=".$user." and likes=1";
}
else if($comm=="insert"){
    $sql="insert into postslikes(posts,user,likes,comment) values(".$postid.",".$user.",'1',NULL)";
}
else{
    $sql="insert into postslikes(posts,user,likes,comment) values(".$postid.",".$user.",NULL,'".$comm."')";
}
mysqli_query ($con,$sql);
$sql="select sum(if(postslikes.likes is null,0,1)) as lik,sum(if(postslikes.comment is null,0,1)) as comm from (posts left join postslikes on posts.postid=postslikes.posts) where posts.postid=".$postid;
$result= mysqli_query ($con,$sql);
$res=mysqli_fetch_assoc($result); 
print_r(json_encode($res));
?>