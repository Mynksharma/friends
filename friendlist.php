<?php 
require 'commonfb.php';
 $us=$_GET['id'];$name=$_SESSION['email'];
 $sql="select first,last from users where id=".$us;
$result=mysqli_query ($con,$sql);$row=mysqli_fetch_array($result);
$namf=$row['first'];
$naml=$row['last'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
    body{margin:0;width:100%;overflow-x:hidden;font-family:'Helvetica';}
.header{background-color:#053075;padding:10px;min-height:70px;color:white;position:fixed;z-index:1030;top:0;right:0;left:0;}
.header-inner{width:85%;margin:0 auto;padding:10px;}
.ab ul{list-style-type:none;margin:0;padding:0;}
.ab li{float:right;position:relative;}
.ab li a{text-decoration:none;color:white;padding-left:20px;font-size:20px;padding-right:20px;position:relative;display:inline-block;}
.ab li .reqcoll{display:none;position:absolute;background-color:white;min-height:50px;min-width:200px;z-index:1;border-radius:5px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);top:40px;right:5px;
}
.ab li .reqcoll .coll{padding:5px 5px;border-bottom:1px solid #F2EDEC;}
.reqcoll div a{color:black;font-size:small;}
    .content-left{width:15%;}
.content-left ul,.rightbar ul{list-style-type:none;margin-left:-40px;}
.content-left li,.rightbar li{padding:10px;margin-bottom:2px;}
.content-left li:hover{background-color:rgba(255,255,255,0.5)}
.content-left li a{text-decoration:none;color:black;}
.content-left li:hover a{color:green;}
.content-right{width:83%;float:left;margin-left:16%;background-color:white;}
.show{display:block;}
.thumb:hover{background-color:#ADB3FF;}

    </style>
<script>
function showfriends(){
    <?php $sql="select CONCAT(users.first,' ',users.last) as name,users.id from friends,users where (select if(friends.friend_id=".$us.",friends.fid,friends.friend_id))=users.id  and friends.request='accept' and (friends.fid=".$us." or friends.friend_id=".$us.")";
$result=mysqli_query($con,$sql);$num=0;
while($r=mysqli_fetch_array($result)){
    if($num==0){?>
 var divi=document.getElementsByClassName("content-right")[0];
	 var d=document.createElement("div");
		d.classList.add("row"); 
        d.style.width="100%";
        d.style.margin="0 auto";
		divi.appendChild(d);
    <?php } ?>
    var d1=document.createElement("div");
    d1.classList.add("col-md-4");
    //d1.style.backgroundColor="pink";
    d1.style.padding="5px";
   //d1.style.margin="2px";
  // d1.style.position="relative";
    d1.style.fontWeight="bold";
    d1.style.height="100px";
    d1.style.borderRadius="5px";
    d.appendChild(d1);
    var dthumb=document.createElement("div");
  dthumb.style.border="1px solid #FAF4F2";
  dthumb.style.borderRadius="5px";
  dthumb.style.position="relative";
  dthumb.style.width="100%";
  dthumb.style.height="100%";
  dthumb.classList.add("thumb");
    d1.appendChild(dthumb);
   var d1_cont=document.createElement("div");
var d1_img=document.createElement("img");
d1_img.setAttribute("src","uploads//default.png");

d1_img.style.height="35px";
d1_img.style.borderRadius="50%";
d1_img.style.border="2px solid blue";
d1_img.style.verticalAlign="middle";
d1_img.style.marginRight="5px";
d1_cont.appendChild(d1_img);
var node=document.createTextNode("<?php echo $r['name']; ?>");
d1_cont.appendChild(node);
dthumb.appendChild(d1_cont);
d1_cont.style.position="absolute";d1_cont.style.margin="auto";d1_cont.style.width="100%";
d1_cont.style.height="30px";d1_cont.style.textAlign="center";
d1_cont.style.top="0";d1_cont.style.bottom="0";d1_cont.style.left="0";d1_cont.style.right="0";
//d1_cont.style.border="1px solid #FAF4F2"
    <?php $num+=1;
    if($num==3) $num=0;
} ?>
}
</script>

</head>
<body onLoad="showfriends();">
<?php include 'header.php'; ?>
<div class="content" style="background-color:#e3e4e5;width:auto;padding:75px 20px;clear:both;display:table;width:100%;min-height:100vh;">
<?php include 'sidebar.php'; ?> 
<div class="content-right" style="width:83%;float:left;margin-left:16%;min-height:80vh;">
<div class="jumbotron" style="text-align:center;padding:10px;width:95%;margin:0 auto;margin-top:10px;margin-bottom:20px;">
<img src="uploads/friendship.png" style="height:40px;margin-right:10px;" />
<h2 style="display:inline-block;margin:0;vertical-align:middle;"><b><?php echo $namf;?> friends' list</b></h2>
</div>

</div>
</div>
</body>
</html>