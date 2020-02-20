<?php 
require 'commonfb.php';$name=$_SESSION['email'];
$id=$_SESSION['id'];
$sql="select first,last from users where email='$name';";
$result=mysqli_query ($con,$sql);$row=mysqli_fetch_array($result);
$namf=$row['first'];
$naml=$row['last'];
$a=$_GET['id'];
$sql="select first,last,date,gender from users where id='$a'";
$result=mysqli_query ($con,$sql);$row=mysqli_fetch_array($result);
$namef=$row['first'];
$namel=$row['last'];
$date=$row['date'];
$gender=$row['gender'];
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=0.83,user-scalable=no">
<style>.content{background-color:#e3e4e5;width:auto;
padding:75px 20px;clear:both;display:table;width:100%;min-height:100vh;}
.cont-center{width:80%;}
.header{background-color:purple;padding:10px;min-height:70px;color:white;position:fixed;z-index:1030;top:0;right:0;left:0;}
.header-inner{width:85%;margin:0 auto;padding:10px;}

.ab ul{list-style-type:none;margin:0;padding:0;}
.ab li{float:right;position:relative;}
.ab li a,#searchicon{text-decoration:none;color:white;padding-left:20px;font-size:20px;padding-right:20px;position:relative;display:inline-block;}
.ab li .reqcoll{display:none;position:absolute;background-color:white;min-height:50px;min-width:200px;z-index:1;border-radius:5px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);top:40px;right:5px;
}
.ab li .reqcoll .coll{padding:5px 5px;border-bottom:1px solid #F2EDEC;}
.reqcoll div a{color:black;font-size:small;}
.content-left{width:15%;}
.content-left ul{list-style-type:none;margin-left:-40px;}
.content-left li{padding:10px;margin-bottom:2px;}
.content-left li:hover{background-color:rgba(255,255,255,0.5);}
.content-left li a{text-decoration:none;color:black;}
.content-left li:hover a{color:green;}
.cont-center{float:left;}
.conback{border-radius:5px;}
.thu{position:absolute;bottom:-20px;z-index:2;width:100%;height:120px;}
#thuprofileimg{height:120px;width:120px;border:2px solid grey;margin:0 0 0 30px;}
.profileDet li a{color:blue;font-weight:bold;text-decoration:none;}
.profileDet li{border:none;padding:10px 25px;text-align:center;display:inline-block;height:100%;width:130px;margin:0px;}
.profileDet li:hover{background-color:rgba(211,211,211,0.5)}
.profileDet li a:hover{color:green}
.intro{margin-top:5px;float:left;background-color:white;min-height:300px;}
#posts{float:left;min-height:300px;margin-top:5px;}
.intro ul li{padding:5px;}
#sidebar{min-width:160px;position:fixed;z-index:5}
    </style>
    <script>function message(){
	    
    	<?php
		 $sq="select posts.status,posts.postid,posts.imgstatus,posts.update_date,CONCAT(users.first,' ',users.last)as name,count(postslikes.likes) as lik,count(postslikes.comment) as comm from (posts left join postslikes on posts.postid=postslikes.posts),users where users.id=posts.userid and users.id='$a'  group by posts.postid  order by update_date DESC;";
		$resul=mysqli_query($con,$sq);
		while($r=mysqli_fetch_array($resul)){ ?>
	 var divi=document.getElementById("posts");
		var d=document.createElement("div");
		d.classList.add("panel");
		d.classList.add("panel-default");
		divi.appendChild(d);
		var d1=document.createElement("div");
		d1.classList.add("panel-heading");
		d.appendChild(d1);
		var img=document.createElement("img");
		img.setAttribute('src',"uploads\\default.png");
		img.style.height="25px";img.style.borderRadius="50%";
		var node=document.createTextNode("<?php echo " ".$r['name'] ?>");
		d1.appendChild(img);
		d1.appendChild(node);
		d1.style.fontWeight="bold";
		var d2=document.createElement("div");
		d2.classList.add("panel-body");
		d.appendChild(d2);var time=document.createElement("p");
		time.style.color="grey";
		time.style.fontSize="13px";
	   var node=document.createTextNode("<?php $d=strtotime($r['update_date']);echo date('d M h:i a',$d)?>");
	   time.appendChild(node);d2.appendChild(time);<?php if(is_null($r['imgstatus'])){?>
		var node=document.createTextNode("<?php echo $r['status'] ?>");
		var d2_main=document.createElement("div");
		d2_main.style.fontStyle="italic";d2_main.style.fontSize="20px";
	   d2_main.appendChild(node);<?php }if(is_null($r['status'])){?>
	   var d2_main=document.createElement("div"); 
	   var img=document.createElement("img");d2_main.style.width="70%";img.style.width="100%";d2_main.style.margin="0 auto";img.style.height="auto";
		img.setAttribute('src',"uploads\\"+"<?php echo $r['imgstatus'];?>");d2_main.appendChild(img);
	        <?php } ?>d2.appendChild(d2_main);
		d2_likes=document.createElement("div");
		var node=document.createTextNode("<?php echo $r['lik']; ?> likes ||<?php echo " ".$r['comm']; ?>  Comments");
		d2_likes.appendChild(node);
		d2_likes.style.marginTop="10px";
		d2_likes.style.color="grey";
		d2_likes.style.fontSize="14px";
		d2_likes.style.fontStyle="italic";
		d2.appendChild(d2_likes);
		var d3=document.createElement("div");
		d3.classList.add("panel-footer");
		d.appendChild(d3);
		var b=document.createElement("button");
		d3.appendChild(b);
		b.classList.add("btn");b.style.border="none";
		b.classList.add("btn-default");var like=document.createElement("i");like.classList.add("fa");like.classList.add("fa-thumbs-o-up");b.appendChild(like);
		b.setAttribute("id","<?php echo $r['postid'];?>")
		var node=document.createTextNode(" Like");
		b.appendChild(node);b.style.fontWeight="bold";	
		b.style.marginRight="10px";
       b.addEventListener("click",function(){
		this.classList.toggle("changeLike");likehandle(this);
	   });

		var c=document.createElement("button");
		
		d3.appendChild(c);c.style.border="none";
		c.classList.add("btn");
		c.classList.add("btn-default");var comment=document.createElement("i");comment.classList.add("fa");comment.classList.add("fa-thumbs-o-up");
        c.appendChild(comment);
		var node=document.createTextNode(" Comment");
		c.appendChild(node);c.style.fontWeight="bold";
    <?php }?>}
	function likehandle(butt){
		var id=butt.getAttribute("id");
     if(butt.classList.contains("changeLike")){
    httpreq(id,"insert",butt); 
	 }

else{ console.log("no contains"); httpreq(id,"delete",butt);}
	}
	function httpreq(id,comm,self){
		var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
				var a= self.parentElement;
				var b=a.previousSibling.children[2];
				var c=this.responseText;
				var decode=JSON.parse(c);
				b.innerHTML= decode['count(likes)']+" likes || "+decode['count(comment)']+" comments";
			}
		};
       xhttp.open("GET","like_insert.php?id="+id+"&comm="+comm,true);xhttp.send();

	}
    
</script>    
    </head>
    <body onLoad="message();"><?php include 'header.php'; ?>
    <div class="content"><?php include 'sidebar.php'; ?>
    <div class="cont-center"><div class="conback"><div style="position:relative;width:100%;" id="backimg">
      <img src="uploads/waterfall.jpg" width="100%" height="100%"/>
        <h2 style="position:absolute;bottom:1px;left:180px;color:white;" id="profname"><b><?php echo $namef." ".$namel ?></b></h2>
		<?php if($a!=$id){?>
		<button  style="position:absolute;bottom:10px;right:20px;" type="button" class="btn btn-primary"><b>Add Friend </b>
		</button><?php } ?>
		<div class="thu">
		<div class="thumbnail" id="thuprofileimg">
<?php if($gender=="Male"){?><img src="uploads/default.png" alt="profile" style="height:100%;width:auto;" />
	<?php }else{?><img src="uploads/defaultf.png" alt="profile" style="height:100%;width:auto;"/><?php } ?></div>
	</div>
	</div>
        <div style="background-color:white;width:100%;position:relative;" class="profileDet">
        <div style="position:absolute;right:1px;" id="profileDetli"><ul style="list-style-type:none;height:100%;margin:0">
        <li><a href="about.php">Message</a></li>
        <li><a href="friendlist.php?id=<?php echo $a ?>">Friends</a></li>
        <li><a href="photos.php">Photos</a></li></ul></div>
		<h3 style="margin:0 auto;text-align:center;padding-top:25px;" id="profileDetname"><b><?php echo $namef." ".$namel ?></b></h3>
        </div>
        </div>
		<div class="intro" style="top:75px;"><div class="jumbotron" style="margin:2px;border-radius:4px;text-align:center;font-size:20px;padding:5px;">
		<i class="fa fa-globe" style="color:Blue;font-size:30px"></i>
		 <b style="vertical-align:text-bottom;">Intro</b></div>
		<div class="container" style="text-align:center;width:100%;"><?php if($a==$id){?><p id="intro_bio"><br><b>Add a short bio to tell people more about yourself</b>
		<br>
		<i class="glyphicon glyphicon-edit" style=""></i><a href="about.php">  Add Bio</a></p><?php } ?><hr><div>
			<ul style="list-style-type:none;padding:0px;margin:0px;text-align:left;font-weight:bold"><li>
				<i class="fa fa-home"></i>  Lives in <?php echo "Sahibabad"; ?></li><li>
					<i class="fa fa-birthday-cake"></i>  Birthday on <?php $d=strtotime($date);echo date('d M',$d);?></li>
        <li><span class="glyphicon glyphicon-heart"></span> <?php echo "Single"; ?></li>
        </ul></div></div></div>        
        <div id="posts"></div>
        </div>
		<script>

var sidebar=document.getElementById('sidebar');
var content_center=document.getElementsByClassName('cont-center')[0];
var searchicon=document.getElementById('searchicon');
var bars=document.getElementById('bars');
var fbicon=document.getElementById('fbicon');
var posts=document.getElementById('posts');
var intro=document.getElementsByClassName('intro')[0];
var profileDetli=document.getElementById('profileDetli');
var thuprofileimg=document.getElementById('thuprofileimg');
var profileDetname=document.getElementById('profileDetname');
var profname=document.getElementById('profname');
var backimg=document.getElementById('backimg');
var conback=document.getElementsByClassName('conback')[0];
var profileDet=document.getElementsByClassName('profileDet')[0];
function myFunction2(y) {
  if (y.matches) {console.log('300-850');
  searchicon.style.display="inline-block";
document.getElementById('searchform').style.display="none";
   sidebar.style.display="none";
   content_center.style.width="100%";
   content_center.style.marginLeft="0";
   conback.style.height="300px";
    intro.style.width="100%";
	intro.style.position="relative";
	posts.style.width="100%";
	backimg.style.height="77%";
    profileDet.style.height="23%";
	posts.style.marginLeft="0";
	intro.style.top="0";
	thuprofileimg.style.margin="0 auto";
	profileDetli.style.display="none";
	profileDetname.style.display="block";
	profname.style.display="none";
   bars.style.display="inline-block";
   fbicon.style.display="none";
  }
}
function myFunction3(z){
	if (z.matches) {console.log('855-1120');
		searchicon.style.display="none";
document.getElementById('searchform').style.display="block";
   sidebar.style.display="none";
   content_center.style.width="100%";
   content_center.style.marginLeft="0";
   conback.style.height="400px";
   backimg.style.height="87%"
   intro.style.width="40%";
   intro.style.position="sticky";
   intro.style.top="75px";
   profileDet.style.height="13%";
	posts.style.width="57%";
	posts.style.marginLeft="3%";
	thuprofileimg.style.margin="0 0 0 30px";
	profileDetli.style.display="block";
	profileDetname.style.display="none";
	profname.style.display="block";
   bars.style.display="inline-block";
   fbicon.style.display="none";
  }
}
function myFunction4(w){
	if (w.matches) {
		console.log('1121-');
		searchicon.style.display="none";
document.getElementById('searchform').style.display="block";
	sidebar.style.display="initial";
  content_center.style.width="83%";
   content_center.style.marginLeft="16%";
   conback.style.height="400px";
   intro.style.width="40%";
   backimg.style.height="87%"
	posts.style.width="57%";
	intro.style.position="sticky";
	profileDet.style.height="13%";
	posts.style.marginLeft="3%";
	intro.style.top="75px";
	thuprofileimg.style.margin="0 0 0 30px";
	profileDetli.style.display="block";
	profileDetname.style.display="none";
	profname.style.display="block";
   bars.style.display="none";
   fbicon.style.display="initial";
	}
  }
var y=window.matchMedia("(min-width:300px) and (max-width:854px)");
var z=window.matchMedia("(min-width:855px) and (max-width:1120px)");
var w=window.matchMedia("(min-width:1121px)");
y.addListener(myFunction2);
z.addListener(myFunction3);
w.addListener(myFunction4);
myFunction2(y);
myFunction3(z);
myFunction4(w);
</script>
    </body>
    </html>