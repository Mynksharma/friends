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
.changeLike:hover{background-color:purple;color:white;}
.changeLike:focus{background-color:purple;color:white;}
.rightbar{float:right;width:14%;}
.rightbar li{text-align:center;font-weight:bold;}
.stories_list{list-style-type:none;padding:0px;margin:0px;}
.stories_list li:hover{background-color:rgba(192,192,192,0.3);}

/*.l{margin:auto;position:absolute;left:0;right:0;top:0;bottom:0;height:100px;width:100px;}
.loader{
    position:absolute;margin:auto;left:0;right:0;top:0;bottom:0;height:30px;width:30px;
    border-left:5px solid #EFAA1E;
border-top:5px solid blue;
border-right:5px solid black;
border-bottom:5px solid red;
border-radius:50%;
animation:load 1s infinite;
}
.h{position:absolute;bottom:0px;text-align:center;width:100%;font-weight:bold}
@keyframes load {
    0%{transform:rotate(0deg);}
    50%{transform:rotate(180deg);}
    100%{transform:rotate(360deg);}

}*/
.lykmodal{padding:5px;font-weight:bold;cursor:pointer;}
.lykmodal:hover{border-bottom:2px solid #8D8FFE;}
.lykmodal:focus{border-bottom:2px solid #8D8FFE;}
.lykmodalheader{background-color:#E8E8E8;border-bottom:2px solid #8D8FFE;}


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
				while(ul.firstChild){
					ul.removeChild(ul.firstChild);
				}
				for(let i of parse){
					var li=document.createElement("li");
					var span=document.createElement("i");span.classList.add("fas");span.classList.add("fa-circle");
					span.style.fontSize="10px";span.style.color="green";li.appendChild(span);
					var node=document.createTextNode("   "+i.name);li.appendChild(node);
					li.style.cursor="pointer";
					li.addEventListener("click",function(){chat(i.userid,i.name);});
					ul.appendChild(li);
				}
			}
		};
       xhttp.open("GET","online.php",true);xhttp.send();

	}
online_check();
setInterval(() => {
	online_check();
}, 5*1000);
function chat(userid,username){
	console.log("yss");
	var x = document.getElementsByTagName("body")[0];
     var d=document.createElement("div");
	 var d_header=document.createElement("div");
	 var d_body=document.createElement("div");
	 var d_footer=document.createElement("div");
	 d.style.position="fixed";
	 d.style.right="10px";
	 d.style.bottom="10px";
     d.style.width="250px";
	 d.style.height="350px";
	 d.style.backgroundColor="white";
	 d.style.borderRadius="5px";
	 d_header.style.width="100%";     
	 var node=document.createTextNode(username);
	 var span=document.createElement("span");
	 span.appendChild(node);span.style.verticalAlign="middle";
	 d_header.appendChild(span);
	 d_header.style.padding="5px";
	 d_header.style.fontWeight="bold";
	 d_header.style.backgroundColor="#DBDCE9";
	 d_header.style.height="10%";
	 var newel=document.createElement("i");
	 newel.style.fontSize="24px";
	 newel.classList.add("fa");
	 newel.style.color="red";
	 d_header.appendChild(newel);
	 newel.innerHTML="&#xf00d;";newel.style.cursor="pointer";
	 newel.addEventListener("click",function(){d.style.display="none";});
     d.appendChild(d_header);
	 newel.style.float="right";
	 d_body.style.width="100%";
	 d_body.style.height="75%";
	 d_body.style.padding="10px";
	 d.appendChild(d_body);
     d_body.style.overflowY="scroll";
	 d_footer.style.height="15%";
	 d_footer.style.width="100%";
	 d_footer.style.backgroundColor="pink";
d_footer.style.padding="10px";
	 var a=document.createElement("input");
	a.style.borderRadius="10px";
	a.setAttribute("type","text");
	a.style.padding="5px";
	a.style.border="none";a.style.verticalAlign="middle";a.style.width="85%";
var send=document.createElement("i");
send.classList.add("material-icons");
send.innerHTML="&#xe163;";send.style.verticalAlign="middle";
send.style.marginLeft="5px";
send.style.color="purple";
send.style.cursor="pointer";
a.setAttribute("placeholder","Your message...");
d_footer.appendChild(a);
d_footer.appendChild(send);
d.style.boxShadow="5px 5px 5px grey";
	 d.appendChild(d_footer);
      x.appendChild(d);msgupdate(d_body,userid);
 send.addEventListener("click",function(){chatadd(userid,a.value);a.value="";
 setTimeout(function(){msgupdate(d_body,userid);},500);});

}
function chatadd(userid,value){
	var xhttp=new XMLHttpRequest();
       xhttp.open("GET","Chat.php?id="+userid+"&msg="+value,true);xhttp.send();
}
function msgupdate(container,userid){
	/*var l=document.createElement("div");
   var loader=document.createElement("div");
   var h2=document.createElement("div");
   l.classList.add("l");loader.classList.add("loader");h2.innerHTML="Loading..";h2.classList.add("h");l.appendChild(loader);l.appendChild(h2);
   container.appendChild(l);*/
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
			
				var c=this.responseText;
				var decode=JSON.parse(c);
				//l.style.display="none";
				
			while(container.firstChild){
					container.removeChild(container.firstChild);
				}
				for(i of decode){
					var msgchip=document.createElement("div");
					msgchip.style.clear="both";
					msgchip.style.padding="5px";
					msgchip.style.marginBottom="5px";
					msgchip.style.borderRadius="4px";
					msgchip.style.maxWidth="70%";
					if(i['userid']==<?php echo $us;?>){
                        msgchip.innerHTML=i['message'];
						//msgchip.style.position="relative";
						msgchip.style.float="right";
						msgchip.style.color="white";
						msgchip.style.backgroundColor="#5E69FA";
					}
					else{
						msgchip.innerHTML=i['message'];
						//msgchip.style.position="relative";
						msgchip.style.float="left";
						msgchip.style.color="white";
						msgchip.style.backgroundColor="#F55EFA";
					}
					container.appendChild(msgchip);
					
				}
                   
			}
		};
       xhttp.open("GET","messages.php?id="+userid,true);xhttp.send();
}
	function message(){
		<?php
		 $sq="select posts.userid,posts.status,posts.imgstatus,posts.postid,posts.update_date,CONCAT(users.first,' ',users.last)as name,sum(if(postslikes.likes IS NULL,0,1)) as lik,sum(if(postslikes.comment IS NULL,0,1)) as comm from (posts left join postslikes on posts.postid=postslikes.posts),users,friends where users.id=posts.userid and (select if(friends.friend_id=".$us." ,friends.fid,friends.friend_id))=users.id  and friends.request='accept' and (friends.fid=".$us." or friends.friend_id=".$us.") group by posts.postid order by update_date DESC";
		$resul=mysqli_query($con,$sq);
		$sql="select posts from postslikes where user=".$us." and likes=1";
		$result=mysqli_query($con,$sql);$array=array();
		$array[]=0;
		while($find=mysqli_fetch_assoc($result)){
			$array[]=$find['posts'];
		}
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
		d2_likes.style.cursor="pointer";
		d2.appendChild(d2_likes);
		d2_likes.setAttribute('data-toggle','modal');
		d2_likes.setAttribute('data-target','#likesmodal');
		d2_likes.addEventListener("click",function(){console.log("yes i called");
		showmodal(<?php echo $r['postid']; ?>);});
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
		<?php if(array_search($r['postid'],$array)){?>
		b.classList.add("changeLike");<?php } ?>
       b.addEventListener("click",function(){
		this.classList.toggle("changeLike");likehandle(this);
	   });

		var c=document.createElement("button");
		d3.appendChild(c);c.style.border="none";
		c.classList.add("btn");
		c.classList.add("btn-default");var comment=document.createElement("i");comment.classList.add("fa");comment.classList.add("fa-commenting-o");
        c.appendChild(comment);
		var node=document.createTextNode(" Comment");
		c.appendChild(node);c.style.fontWeight="bold";
		c.addEventListener("click",function(){this.style.display="none";
		commentbox(this)});
	<?php }?>
	}
	
	function choose(){
		var photo=document.getElementById("files");
	photo.click();document.getElementById('files').addEventListener('change',handleFileSelect,false);
	
	}
function commentbox(event){
	
	var a=document.createElement("input");
	a.style.borderRadius="10px";
	a.setAttribute("type","text");
	a.style.padding="5px";
	a.style.border="none";a.style.verticalAlign="middle";a.style.width="200px";
var send=document.createElement("i");
send.classList.add("material-icons");
//send.appendChild(document.createTextNode("&#xe163;"));
//send.style.pointerEvents="none";
send.innerHTML="&#xe163;";send.style.verticalAlign="middle";
send.style.marginLeft="5px";
send.style.color="purple";
send.style.cursor="pointer";
a.setAttribute("placeholder","Write your comment...");
event.parentElement.appendChild(a);
event.parentElement.appendChild(send);
send.addEventListener("click",function(){
httpreq(a.parentElement.firstElementChild.getAttribute("id"),a.value,this);
a.value="";
});

}
/*function sendComment(comment,id,self){
	var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
				var a= self.parentElement;
				var b=a.previousSibling.children[2];
				var c=this.responseText;
				var decode=JSON.parse(c);
				b.innerHTML= decode['lik']+" likes . "+decode['comm']+" Comments";
			}
		};
       xhttp.open("GET","like_insert.php?id="+id+"&comm="+comment,true);xhttp.send();
}*/
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
				b.innerHTML= decode['lik']+" likes . "+decode['comm']+" Comments";

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
var z=0;
	function showmodal(postid){
       z++;if(z==1){
		var d1=document.createElement("div");
		d1.classList.add('modal');d1.setAttribute('id','likesmodal');
		document.getElementsByTagName('body')[0].appendChild(d1);
		var d2=document.createElement("div");
		d2.classList.add('modal-dialog');d2.classList.add('modal-sm');
		d1.appendChild(d2);
		var d3=document.createElement("div");
		d3.classList.add('modal-content');
		var d4=document.createElement("div");
		d4.classList.add('modal-header');
		d3.appendChild(d4);d2.appendChild(d3);
		var span1=document.createElement('span');
		span1.classList.add('lykmodal');span1.innerHTML="Likes";
		span1.addEventListener("click",function(){if(!span1.classList.contains('lykmodalheader')){
			span1.classList.toggle('lykmodalheader');span2.classList.toggle('lykmodalheader');
			ullik.style.display="block";ulcom.style.display="none";
		}});
		var span2=document.createElement('span');
		span2.classList.add('lykmodal');span2.innerHTML="Comments"
		span2.addEventListener("click",function(){if(!span2.classList.contains('lykmodalheader')){
			span2.classList.toggle('lykmodalheader');span1.classList.toggle('lykmodalheader');
			ulcom.style.display="block";ullik.style.display="none";
		}});
		span1.style.marginRight="2px";
		var btn=document.createElement("button");
		btn.classList.add('close');btn.setAttribute('type','button');btn.setAttribute('data-dismiss','modal');
		btn.addEventListener("click",function(){while(ullik.firstChild){
			ullik.removeChild(ullik.firstChild);
		}
		while(ulcom.firstChild){
			ulcom.removeChild(ulcom.firstChild);
		}
		}
		);
		btn.innerHTML="&times;";d4.appendChild(span1);d4.appendChild(span2);d4.appendChild(btn);
		var d5=document.createElement("div");
		d5.classList.add('modal-body');d3.appendChild(d5);
		var ullik=document.createElement('ul');ullik.style.margin="0";ullik.style.listStyleType="none";ullik.style.padding="0";d5.appendChild(ullik);
		var ulcom=document.createElement('ul');ulcom.style.margin="0";ulcom.style.listStyleType="none";ulcom.style.padding="0";d5.appendChild(ulcom);
		ullik.style.display="none";
		ulcom.style.display="none";
		}
		
		var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
				var c=this.responseText;
				var decode=JSON.parse(c);console.log(decode);
				/*if(d5.firstChild){
					d5.removeChild(d5.firstChild);
				}
				//var ul=document.createElement('ul');ul.style.margin="0";ul.style.padding="0";d5.appendChild(ul);*/
				if(!span1.classList.contains('lykmodalheader')){span1.classList.toggle('lykmodalheader')};
			    for(i of decode){
					if(i['likes']=='1'){
					var li=document.createElement('li');
					ullik.appendChild(li);
					li.style.padding="5px";
					li.style.color="red";
					li.style.fontWeight="bold";
					li.innerHTML=i['name'];
					} 
					if(i['comment']!=null && i['comment']!=''){
						var li=document.createElement('li');
					ulcom.appendChild(li);
					var div=document.createElement("div");
					div.style.padding="5px";
					div.style.backgroundColor="#EFEFF5";
					div.style.borderRadius="5px";
					div.style.color="black";div.style.fontWeight="bold";
					var img=document.createElement("img");
		           img.setAttribute('src',"uploads\\default.png");
		          img.style.height="25px";img.style.borderRadius="50%";
				  img.style.border="2px solid blue";img.style.padding="3px";img.style.verticalAlign="middle";img.style.marginRight="5px";
                  div.appendChild(img);
					var span=document.createElement("span");
					span.innerHTML=i['name'];
					div.appendChild(span);
					var p=document.createElement("p");
					p.innerHTML=i['comment'];
					p.style.marginLeft="30px";
					p.style.color="red";
					div.appendChild(p);
					li.appendChild(div);
					li.style.marginBottom="3px";
					}
				}
           ullik.style.display="block";

			}
		};
       xhttp.open("GET","likes_modal.php?postid="+postid,true);xhttp.send();

	}
	</script>
	<head></head>
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
<input type="submit" name="submit" id="up" style="display:none;" /></form><button class="btn btn-primary bta" data-toggle="modal" data-target="#mymodal">Photo/video</button><button class="btn btn-primary">Feeling/Activity</button></div></div>
</div>
<div class="content-center-right">
<div class="panel panel-default"><div class="panel-heading"><b>Stories</b></div><div class="panel-body" style="min-height:60px;">
<ul class="stories_list"><li style="cursor:pointer;padding:5px;" onclick="showmodal();"><i class="material-icons" style="vertical-align:middle;color:blue;font-size:35px;">&#xe148; </i><span><b> Add your story</b></span><hr style="margin-top:5px;margin-bottom:0;"></li>
<?php  $sq="select CONCAT(users.first,' ',users.last)as name,users.id,stories.update_time from stories,users,friends where stories.userid=users.id and friends.friend_id=stories.userid and friends.request='accept' and friends.fid=".$us." order by stories.update_time desc LIMIT 2";
		$resul=mysqli_query($con,$sq);
		while($r=mysqli_fetch_array($resul)){  ?>
<li data-x="<?php echo $r['id'];?>" style="font-weight:bold;cursor:pointer;padding:8px;"><img src="uploads\default.png" style="height: 35px; border-radius: 50%; border: 2px solid blue; padding: 3px; vertical-align: middle; margin-right: 5px;"/><?php echo $r['name']; ?></li>
		<?php }  ?>
</ul>
</div><div class="panel-footer"><a href="strories.php" style="text-decoration:none;"><button class="btn btn-default btn-block">See more</button></a></div></div>
</div>
<div class="rightbar"><h1 style="font-size:18px;text-align:center;"><b>Online friends</b></h1><ul id="rightbar_ul"></ul></div>
</div>
</body>
</html>