<?php
require 'commonfb.php';
$us=$_SESSION['id'];
 $sq="select posts.userid,posts.status,posts.imgstatus,posts.postid,posts.update_date,CONCAT(users.first,' ',users.last)as name,sum(if(postslikes.likes IS NULL,0,1)) as lik,sum(if(postslikes.comment IS NULL,0,1)) as comm from (posts left join postslikes on posts.postid=postslikes.posts),users,friends where users.id=posts.userid and (select if(friends.friend_id=".$us." ,friends.fid,friends.friend_id))=users.id  and friends.request='accept' and (friends.fid=".$us." or friends.friend_id=".$us.") group by posts.postid order by update_date DESC LIMIT 5";
$resul=mysqli_query($con,$sq);
$sql="select posts from postslikes where user=".$us." and likes=1";
$result=mysqli_query($con,$sql);$array=array();
$array[]=0;$posts=array();
while($find=mysqli_fetch_assoc($result)){	
$array[]=$find['posts'];
}
while($r=mysqli_fetch_assoc($resul)){ 
    if(array_search($r['postid'],$array)){$mylike='yes';}
    else{$mylike='no';}
array_push($posts,["userid"=>$r['userid'],"id"=>$r['postid']
,"status"=>$r['status'],"imgstatus"=>$r['imgstatus'],"update_date"=>$r['update_date'],"name"=>$r['name'],"likes"=>$r['lik'],"comments"=>$r['comm'],'mylike'=>$mylike
]);
}
$posts=json_encode($posts);
//return $posts;
header('Content-Type: application/json');
echo $posts;
?>

