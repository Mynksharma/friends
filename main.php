<?php 
require 'commonfb.php';
if(isset($_SESSION['email'])){
	$name=$_SESSION['email'];
$sql="select first,last from users where email='$name';";
$result=mysqli_query ($con,$sql);$row=mysqli_fetch_array($result);
$namf=$row['first'];
$naml=$row['last'];
 $us=$_SESSION['id'];}
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
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=0.83,user-scalable=no">
	<meta name="theme-color" content="white">
	<link rel="manifest" href="manifest.json"/>
<style>

body{margin:0;width:100%;overflow-x:hidden;font-family:'Helvetica';}
.header{background-color:purple;padding:10px;min-height:70px;color:white;position:fixed;z-index:5;top:0;right:0;left:0;}
.header-inner{width:85%;margin:0 auto;padding:10px;}
.ab ul{list-style-type:none;margin:0;padding:0;float:right;}
.ab{float:right;}
.ab li{float:right;position:relative;}
.ab li a,#searchicon{text-decoration:none;color:white;padding-left:20px;font-size:20px;padding-right:20px;position:relative;display:inline-block;}
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
.content-center{width:50%;float:left;margin-left:16%;min-width:400px;}
.bta{margin-right:10px;}
.content-center-right{width:20%;float:left;height:auto;min-width:200px;}
.show{display:block;}
.changeLike{background-color:purple;color:white;}
.changeLike:hover{background-color:purple;color:white;}
.changeLike:focus{background-color:purple;color:white;}
.rightbar{float:right;width:13%;min-width:150px;margin-left:2px;background-color:rgb(192, 192, 199);border-radius:5px;}
#offlinediv{width:32%;background-color:white;border-radius:5px;margin-left:2px;float:right;display:none;padding:10px;margin-bottom:20px;}
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
#sidebar{min-width:160px;position:fixed;}
</style>
<script>
function btntosidebar(){
	let side=document.getElementById("sidebar");if(side.style.display==="none") side.style.display="initial";else  side.style.display="none";}
		document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'interactive') {
    var body=document.body;
		  var div=document.createElement('div');
		  div.style.height="100vh";
		  div.style.width="100vw";
		  div.classList.add('loading');
		  var img=document.createElement('img');
		  img.setAttribute('src',"spinner.svg");
		  img.style.height="200px";
		  img.style.width="200px";
		  div.appendChild(img);
		  div.style.zIndex="5";
		  body.style.overflowY="hidden";
		  body.insertBefore(div,body.firstChild);
		  div.style.position="absolute";
		  img.style.position="absolute";
		  img.style.top="0";
		  img.style.bottom="0";
		  img.style.left="0";
		  img.style.right="0";
		  img.style.margin="auto";
		  div.style.backgroundColor="white";

  }
  else if (event.target.readyState === 'complete') {
		var div=document.getElementsByClassName('loading')[0];
		div.remove();
		document.body.style.overflowY="initial";
  }
});
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
	if(navigator.onLine){
online_check();
setInterval(() => {
	online_check();
}, 5*1000);}
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
var url='postsindexed.php';
fetch(url)
.then(function(res){
 console.log('fetchformmain',res);
})
	function message(){
		if(navigator.onLine){
		<?php
		 $sq="select posts.userid,posts.status,posts.imgstatus,posts.postid,posts.update_date,CONCAT(users.first,' ',users.last)as name,sum(if(postslikes.likes IS NULL,0,1)) as lik,sum(if(postslikes.comment IS NULL,0,1)) as comm from (posts left join postslikes on posts.postid=postslikes.posts),users,friends where users.id=posts.userid and (posts.userid=".$us." or ((select if(friends.friend_id=".$us." ,friends.fid,friends.friend_id))=users.id  and friends.request='accept' and (friends.fid=".$us." or friends.friend_id=".$us."))) group by posts.postid order by update_date DESC";
		$resul=mysqli_query($con,$sq);
		$sql="select posts from postslikes where user=".$us." and likes=1";
		$result=mysqli_query($con,$sql);$array=array();
		$array[]=0;
		while($find=mysqli_fetch_assoc($result)){
			$array[]=$find['posts'];
		}
		while($r=mysqli_fetch_array($resul)){ 
			if(array_search($r['postid'],$array)) $mylike='yes';
			else $mylike='no';
			?> 
		content("<?php echo ' '.$r['name'] ?>","<?php $d=strtotime($r['update_date']);echo date('d M h:i a',$d)?>","<?php if(is_null($r['status'])){echo 'null';} else{echo $r['status'];}?>","<?php  if(is_null($r['imgstatus'])){echo 'null';} else{echo $r['imgstatus'];}?>","<?php echo $r['lik']; ?> likes .<?php echo " ".$r['comm']; ?>  Comments","<?php echo $r['postid'];?>","<?php echo $mylike ?>");
		<?php }?>}
		else{
			if('indexedDB' in window){
            readAllData('posts')
            .then(function(data){
				data.reverse();
            if(data.length!=0){
               for(let item of data){
				   if(item.status==null) item.status='null';
				   if(item.imgstatus==null) item.imgstatus='null';
				content(item.name,item.update_date,item.status,item.imgstatus,item.likes+' likes .'+item.comments+' Comments',item.id,item.mylike);
			   }
             }
             }
			)
		}
	}
}

function content(name,update_date,status,imgstatus,likes_comments,postid,mylike){
		var divi=document.getElementById("main");
		var d=document.createElement("div");
		d.classList.add("panel");
		d.classList.add("panel-default");
		divi.appendChild(d);
		var d1=document.createElement("div");
		d1.classList.add("panel-heading");
		d.appendChild(d1);
		var img=document.createElement("img");
		img.setAttribute('src',"static_images\\default.png");
		img.style.height="25px";img.style.borderRadius="50%";
		var node=document.createTextNode(name);
		d1.appendChild(img);
		d1.appendChild(node);
		d1.style.fontWeight="bold";
		var d2=document.createElement("div");
		d2.classList.add("panel-body");
		d.appendChild(d2);var time=document.createElement("p");
		time.style.color="grey";
		time.style.fontSize="13px";
	   var node1=document.createTextNode(update_date);
	   time.appendChild(node1);
	   d2.appendChild(time);
	   if(imgstatus=='null'){
		var node=document.createTextNode(status);
		var d2_main=document.createElement("div");
		d2_main.style.fontStyle="italic";d2_main.style.fontSize="20px";
	   d2_main.appendChild(node); }
	   if(status=='null'){
	   var d2_main=document.createElement("div"); 
	   var img=document.createElement("img");d2_main.style.width="70%";img.style.width="100%";d2_main.style.margin="0 auto";img.style.height="auto";
		img.setAttribute('src',"uploads\\"+imgstatus);d2_main.appendChild(img);
			 } 
			d2.appendChild(d2_main);
		d2_likes=document.createElement("div");
		var node=document.createTextNode(likes_comments);
		d2_likes.appendChild(node);
		d2_likes.style.marginTop="10px";
		d2_likes.style.color="grey";
		d2_likes.style.fontSize="14px";
		d2_likes.style.fontStyle="italic";
		d2_likes.style.cursor="pointer";
		d2.appendChild(d2_likes);
		d2_likes.setAttribute('data-toggle','modal');
		d2_likes.setAttribute('data-target','#likesmodal');
		d2_likes.addEventListener("click",function(){
		showmodal(postid);
	});
		var d3=document.createElement("div");
		d3.classList.add("panel-footer");
		d.appendChild(d3);
		var b=document.createElement("button");
		d3.appendChild(b);
		b.classList.add("btn");b.style.border="none";
		b.classList.add("btn-default");var like=document.createElement("i");like.classList.add("fa");like.classList.add("fa-thumbs-o-up");b.appendChild(like);
		b.setAttribute("id",postid) 
		var node=document.createTextNode(" Like");
		b.appendChild(node);b.style.fontWeight="bold";	
		b.style.marginRight="10px";
	    if(mylike=='yes'){
		b.classList.add("changeLike");
		 }
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
	}

	window.addEventListener('load', function() {
		if(!navigator.onLine){
	var storysection=document.getElementsByClassName('content-center-right')[0];
	var onlinesection=document.getElementsByClassName('rightbar')[0];
	storysection.innerHTML="";
	onlinesection.innerHTML="";
   var offlinediv= document.getElementById('offlinediv');
   offlinediv.style.display="block";
   var headsection=document.getElementById('headsection');headsection.innerHTML='';
   headsection.innerHTML='<div class="header" style="min-width:400px;"><div class="header-inner"><span class="fa" id="bars" style="font-size:30px;float:left;margin-right:20px;cursor:pointer;" onClick="btntosidebar();">&#xf039;</span><h2 style="float:left;margin:0;margin-right:40px;"><b>F.R.I.E.N.D.S</b></h2></div></div>';
}
	});
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
	image.src="static_images\\default.png";
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
		           img.setAttribute('src',"static_images\\default.png");
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
					   <img src="static_images\default.png" style="display:block;margin:auto;" height="100px" id="image"><br><br>
						<button class="btn btn-primary bta" onclick="choose();" style="margin-right:20px;">Choose Photo</button>
					<button class="btn btn-primary bta" onclick="upload();"  id="upload" disabled>Upload Photo</button>
					</div>
				</div>
			</div>
		</div>
		
<div id="headsection">
	<?php include 'header.php'; ?></div>
<div class="content" style="background-color:#e3e4e5;width:auto;padding:75px 20px;clear:both;display:table;width:100%;min-height:100vh;">
<?php include 'sidebar.php'; ?>
<div class="content-center" id="main"><div class="panel panel-default" id="addpost"><div class="panel-heading" style="font-size:20px;">
<b>Add Post</b>
<button type="submit" form="stat" class="btn btn-success" style="float:right;font-size:10px;"><b>Post</b>
</button></div><div class="panel-body"><form id="stat">
	<textarea type="text" placeholder="What's on your mind?" style="width:100%;border:none;resize:none;" name="status" id="statarea">
</textarea></form></div><div class="panel-footer"><form action="upload.php?src=main" method="POST" enctype="multipart/form-data" id="imgform">
<input type="file" name="file" id="files" style="display:none;"/>
<input type="submit" name="submit" id="up" style="display:none;" /></form><button class="btn bta" style="background-color:purple;color:white" data-toggle="modal" data-target="#mymodal">Photo/video</button><button class="btn" style="background-color:purple;color:white">Feeling/Activity</button></div></div>
</div>
<div class="content-center-right">
<div class="panel panel-default" id="stories_cont"><div class="panel-heading"><b>Stories</b></div><div class="panel-body" style="min-height:60px;">
<ul class="stories_list"><li style="cursor:pointer;padding:5px;" onclick="showmodal();"><i class="material-icons" style="vertical-align:middle;color:blue;font-size:35px;">&#xe148; </i><span><b> Add your story</b></span><hr style="margin-top:5px;margin-bottom:0;"></li>
<?php  $sq="select CONCAT(users.first,' ',users.last)as name,users.id,stories.update_time from stories,users,friends where stories.userid=users.id and friends.friend_id=stories.userid and friends.request='accept' and friends.fid=".$us." order by stories.update_time desc LIMIT 2";
		$resul=mysqli_query($con,$sq);
		while($r=mysqli_fetch_array($resul)){  ?>
<li data-x="<?php echo $r['id'];?>" style="font-weight:bold;cursor:pointer;padding:8px;"><img src="static_images\default.png" style="height: 35px; border-radius: 50%; border: 2px solid blue; padding: 3px; vertical-align: middle; margin-right: 5px;"/><?php echo $r['name']; ?></li>
		<?php }  ?>
</ul>
</div><div class="panel-footer"><a href="strories.php" style="text-decoration:none;"><button class="btn btn-default btn-block">See more</button></a></div></div>
</div>
<div class="rightbar"><h1 style="font-size:18px;text-align:center;"><b>Online friends</b></h1><ul id="rightbar_ul"></ul></div>
<div id="offlinediv">
<img src="static_images/offline.svg" alt="" style="width:100px;height:100px;margin:auto;display:block;margin-top:10px;">
<h3 style="text-align:center;"><i>You are offline!!</i></h3>
</div>
</div>
<script>
var sidebar=document.getElementById('sidebar');
var main=document.getElementById('main');
var contentt=document.getElementsByClassName('content')[0];
var content_center_right=document.getElementsByClassName('content-center-right')[0];
var rightbar=document.getElementsByClassName('rightbar')[0];
var stories_list=document.getElementsByClassName('stories_list')[0].children[0];
var stories_cont=document.getElementById('stories_cont');
var addpost=document.getElementById('addpost');
var main=document.getElementById('main');
var searchicon=document.getElementById('searchicon');
var bars=document.getElementById('bars');
var fbicon=document.getElementById('fbicon');
var offlinediv=document.getElementById('offlinediv');
function myFunction2(y) {
  if (y.matches) {console.log('300-850');
	if(navigator.onLine){
  searchicon.style.display="inline-block";
  main.insertBefore(stories_cont,addpost.nextSibling);
  document.getElementById('searchform').style.display="none";
   content_center_right.style.width="100%";
   rightbar.style.display="none";
   stories_list.style.textAlign="center";
   fbicon.style.display="none";}
   else{
	   offlinediv.style.float='none';
	   offlinediv.style.width='100%';
	main.insertBefore(offlinediv,addpost.nextSibling);
   }
   bars.style.display="inline-block";
   sidebar.style.display="none";
   main.style.marginLeft="0";
   main.style.width="100%";
  }
}
function myFunction3(z){
	if (z.matches) {console.log('855-1120');
		if(navigator.onLine){
		content_center_right.insertBefore(stories_cont,content_center_right.firstChild);
		searchicon.style.display="none";
document.getElementById('searchform').style.display="block";
   content_center_right.style.width="20%";
   rightbar.style.display="none";
   stories_list.style.textAlign="left";
   fbicon.style.display="none";}
   else{
	   offlinediv.style.float='right';
	   offlinediv.style.width='20%';
	   contentt.insertBefore(offlinediv,contentt.lastChild);
   }
   bars.style.display="inline-block";
   sidebar.style.display="none";
   main.style.width="75%";
   main.style.marginLeft="0";
  }
}
function myFunction4(w){
	if (w.matches) {
		console.log('1121-');
		if(navigator.onLine){
		content_center_right.insertBefore(stories_cont,content_center_right.firstChild);
		searchicon.style.display="none";
document.getElementById('searchform').style.display="block";
   content_center_right.style.width="20%";
  rightbar.style.display="initial";
   stories_list.style.textAlign="left";
   fbicon.style.display="initial";}
   else{
	   offlinediv.style.float='right';
	   offlinediv.style.width='32%';
	   contentt.insertBefore(offlinediv,contentt.lastChild);
   }
   sidebar.style.display="initial";
   bars.style.display="none";
   main.style.width="50%";
   main.style.marginLeft="16%";
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
<script src="idb.js"></script> 
	<script src="utility.js"></script>
	<script>
	var form=document.querySelector('#stat');
	form.addEventListener('submit',function(event){
		event.preventDefault();
		var c=document.getElementById('statarea').value;
		document.getElementById('statarea').value='';
		if('serviceWorker' in navigator && 'SyncManager' in window){
			navigator.serviceWorker.ready
			.then(function(sw){
				var post={
					id:new Date().toISOString(),
					p:c
				};
				writeData('sync-posts',post).then(function(){
					return sw.sync.register('sync-new-posts');
				})
				.then(function(){displayConfirmNotification();})
			})
			.catch((err)=>{
				console.log(err);
			})
		}
	})
	function displayConfirmNotification(){
    var options={
    body:'New post added!!',
    icon:'/phplearning/facebook/src/icons/network96.png',
    image:'/phplearning/facebook/src/icons/network256.png',
    dir:'ltr',
    lang:'en-US',//BCP 47
    vibrate:[100,50,200],
    badge:'/phplearning/facebook/src/icons/network96.png',
    tag:'confirm-notification',
    renotify:true,
    actions:[
        {action:'confirm' ,title:'Okay'},
        {action:'cancel' ,title:'Cancel'},
    ]
    }
    //new Notification('Successfully subscribed',options)
    navigator.serviceWorker.ready
    .then(function(swreg){
        swreg.showNotification('New post added!!',options);
    });
}

function askfornotificationpermission(){
    Notification.requestPermission(function(result){
        console.log('User choice',result);
        if(result!='granted'){
            console.log('NO notification permission granted');
        }
    })
}
askfornotificationpermission();
	</script>
</body>
</html>