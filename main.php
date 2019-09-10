<?php 
require 'commonfb.php';$name=$_SESSION['email'];
$sql="select first,last from users where email='$name';";
$result=mysqli_query ($con,$sql);$row=mysqli_fetch_array($result);
$namf=$row['first'];
$naml=$row['last'];
 $us=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
.content-center{width:50%;float:left;margin-left:16%;}
.bta{margin-right:10px;}
.content-center-right{width:20%;float:left;height:auto;}
.show{display:block;}
.changeLike{background-color:purple;color:white;}
.rightbar{float:right;width:14%;}
.rightbar li{text-align:center;font-weight:bold;}
</style>
<script>
	
function online_check(){
	var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
				var data=this.responseText;
				var parse=JSON.parse(data);
				var ul=document.getElementById("rightbar_ul");
				var ulchild=document.getElementById("rightbar_ul").children;
				for(let j of ulchild){
					ul.removeChild(j);
				}
				for(let i of parse){
					var li=document.createElement("li");
					var span=document.createElement("i");span.classList.add("fas");span.classList.add("fa-circle");
					span.style.fontSize="10px";span.style.color="green";li.appendChild(span);
					var node=document.createTextNode("   "+i.name);li.appendChild(node);
					ul.appendChild(li);
				}
			}
		};
       xhttp.open("GET","online.php",true);xhttp.send();

	}
online_check();
//setInterval(() => {
//	online_check();
//}, 5*1000);
	function message(){
		<?php
		 $sq="select posts.userid,posts.status,posts.imgstatus,posts.postid,posts.update_date,CONCAT(users.first,' ',users.last)as name,count(postslikes.likes) as lik,count(postslikes.comment) as comm from (posts left join postslikes on posts.postid=postslikes.posts),users,friends where users.id=posts.userid and friends.friend_id=users.id  and friends.request='accept' and friends.fid=".$us." 
		  group by posts.postid order by update_date DESC;";
		$resul=mysqli_query($con,$sq);
		while($r=mysqli_fetch_array($resul)){ ?>
	 var divi=document.getElementById("main");
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
		var node=document.createTextNode("<?php echo $r['lik']; ?> likes .<?php echo " ".$r['comm']; ?>  Comments");
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
		
	<?php }?>
	}
	
	function choose(){
		var photo=document.getElementById("files");
	photo.click();document.getElementById('files').addEventListener('change',handleFileSelect,false);
	
	}

  function handleFileSelect(evt) {
	  document.getElementById("upload").disabled=false;
    var fils = evt.target.files;
for(var i=0,f;f=fils[i];i++){
      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
			var img=document.getElementById("image");
		img.src=e.target.result;
        };
      })(f);
	  reader.readAsDataURL(f);
}
  }
	function upload(){
		var photo1=document.getElementById("up");
		photo1.click();			
	}

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
				b.innerHTML= decode['count(likes)']+" likes . "+decode['count(comment)']+" comments";
			}
		};
       xhttp.open("GET","like_insert.php?id="+id+"&comm="+comm,true);xhttp.send();

	}
	function deletetempimg(){
		document.getElementById("upload").disabled=true;
		var a=document.getElementById("imgform");
	a.reset();
	var image=document.getElementById("image");
	image.src="uploads\\default.png";
	}
	</script>
</head>
<body onLoad="message();">
<div class="modal " id="mymodal">
             <div class="modal-sm modal-dialog modal-dialog-centered">
                <div class="modal-content">
				    <div class="modal-header">
					   <h2>Upload 
						 <button type="button" class="close" data-dismiss="modal" onclick="deletetempimg();">&times;
							</button></h2>
					</div>
					<div class="modal-body">
					   <img src="uploads\default.png" style="display:block;margin:auto;" height="100px" id="image"><br><br>
						<button class="btn btn-primary bta" onclick="choose();" style="margin-right:20px;">Choose Photo</button>
					<button class="btn btn-primary bta" onclick="upload();"  id="upload" disabled>Upload Photo</button>
					</div>
				</div>
			</div>
		</div>



<?php include 'header.php'; ?>
<div class="content" style="background-color:#e3e4e5;width:auto;padding:75px 20px;clear:both;display:table;width:100%;min-height:100vh;">
<?php include 'sidebar.php'; ?>
<div class="content-center" id="main"><div class="panel panel-default"><div class="panel-heading" style="font-size:20px;">
<b>Add Post</b>
<button type="submit" form="stat" class="btn btn-success" style="float:right;font-size:10px;"><b>Post</b>
</button></div><div class="panel-body"><form id="stat" method="POST" action="post.php" >
	<textarea type="text" placeholder="What's on your mind?" style="width:100%;border:none;resize:none;" name="status">
</textarea></form></div><div class="panel-footer"><form action="upload.php" method="POST" enctype="multipart/form-data" id="imgform">
<input type="file" name="file" id="files" style="display:none;"/>
<input type="submit" name="submit" id="up" style="display:none;"></form><button class="btn btn-primary bta" data-toggle="modal" data-target="#mymodal">Photo/video</button><button class="btn btn-primary">Feeling/Activity</button></div></div>
</div>
<div class="content-center-right">
<div class="panel panel-default"><div class="panel-heading"><b>Stories</b></div><div class="panel-body" style="min-height:60px;"></div><div class="panel-footer"><button class="btn btn-default btn-block">See more</button></div></div>
</div>
<div class="rightbar"><h1 style="font-size:18px;text-align:center;"><b>Online friends</b></h1><ul id="rightbar_ul"></ul></div>
</div>
</body>
</html>