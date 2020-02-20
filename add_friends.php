<?php 
require 'commonfb.php';$name=$_SESSION['email'];
$us=$_SESSION['id'];
$sql="select first,last from users where email='$name';";
$result=mysqli_query ($con,$sql);$row=mysqli_fetch_array($result);
$namf=$row['first'];
$naml=$row['last'];?>
<!DOCTYPE html>
<html>
<head>
<title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=0.83,user-scalable=no">
<style>
.header{background-color:purple;padding:10px;min-height:70px;color:white;position:fixed;z-index:1030;top:0;right:0;left:0;}
.header-inner{width:85%;margin:0 auto;padding:10px;}

.ab ul{list-style-type:none;margin:0;padding:0;}
.ab li{float:right;position:relative;}
.ab li a,#searchicon{text-decoration:none;color:white;padding-left:20px;font-size:20px;padding-right:20px;position:relative;display:inline-block;}
.ab li .reqcoll{display:none;position:absolute;background-color:white;min-height:50px;min-width:200px;z-index:1;border-radius:5px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);top:40px;right:5px;
}
.ab li .reqcoll .coll{padding:5px 5px;border-bottom:1px solid #F2EDEC;}
.reqcoll div a{color:black;font-size:small;}
#fb_icon{font-size:30px;float:left;margin-right:30px;}
.content-left{width:15%;}
.content-left ul{list-style-type:none;margin-left:-40px;}
.content-left li{padding:10px;margin-bottom:2px;}
.content-left li a{text-decoration:none;color:black;}
.content-left li:hover{background-color:rgba(255,255,255,0.5);}
.content-left li:hover a{color:green;}
#sear{width:300px;color:black;border:none;padding:5px;height:30px;}
.cancel{background-color:blue;
color:white;}
.cancel:hover,.cancel:focus{background-color:blue;
color:white;}
#sidebar{min-width:160px;position:fixed;z-index:2}
</style>
<script>
	function message(){
		<?php $sq="select id,first,last,gender from users where email!='$name';";$resul=mysqli_query($con,$sq);
		$sq="select friend_id from friends where fid=".$_SESSION['id']." and request='waiting'";
		$resu=mysqli_query($con,$sq);$array=array();
		$array[]=0;
		while($find=mysqli_fetch_assoc($resu)){
			$array[]=$find['friend_id'];
		}
		$num=0;while($r=mysqli_fetch_array($resul)){?>
	 <?php if($num==0){?>
	 var divi=document.getElementById("main");
	 var d=document.createElement("div");
		d.classList.add("row"); 
		divi.appendChild(d);<?php }?>
		var link=document.createElement("a");
		link.setAttribute('href',"profile.php?id=<?php echo $r['id'] ?>");
		link.style.textDecoration="none";
		var d7=document.createElement("div");
		d7.classList.add("col-lg-3");
		d7.classList.add("col-sm-6");
		d7.classList.add("col-xs-12");
		d7.style.padding="0 10px 0 10px";
		d.appendChild(d7);
		var d1=document.createElement("div");
		d1.classList.add("panel");
		d1.classList.add("panel-default");
		d7.appendChild(d1);
		var d2=document.createElement("div");
		d2.classList.add("panel-heading");
		d1.appendChild(d2);
		var node=document.createTextNode("<?php echo $r['first'].' '.$r['last']?>");
		d2.appendChild(node);
		d2.style.fontWeight="bold";
		d2.style.fontSize="18px";
		var d3=document.createElement("div");
		d3.classList.add("panel-body");
		d1.appendChild(d3);
		d3.style.padding="0px";
		var thumb=document.createElement("div");
		thumb.classList.add("thumbnail");
		d3.appendChild(thumb);
		thumb.style.border="none";
		thumb.style.marginBottom="0";
			var image=document.createElement("img");<?php if($r['gender']=="Male"){?>
			image.src="uploads\\default.png";<?php }else{?>image.src="uploads\\defaultf.png";<?php }?>
			image.style.height="160px";
			thumb.appendChild(link);
			link.appendChild(image);
			var capt=document.createElement("div");
		capt.classList.add("caption");
		thumb.appendChild(capt);
		var node=document.createTextNode("3 mutual friends");
		capt.appendChild(node);
		capt.style.color="grey";
		capt.style.textAlign="center";
		var d4=document.createElement("div");
		d4.classList.add("panel-footer");
		d1.appendChild(d4);
		var b=document.createElement("button");
		d4.appendChild(b);
		b.classList.add("btn");
		b.classList.add("btn-success");
		b.classList.add("btn-block");
		b.setAttribute("data-x",<?php echo $r['id']?>);
		<?php if(array_search($r['id'],$array)){?>
		var node=document.createTextNode("Request Sent");console.log("yes if wns");
		b.classList.add("cancel"); <?php } else{?>
		var node=document.createTextNode("Add Friend"); console.log("adddd");<?php } ?>
		b.appendChild(node);b.style.fontWeight="bold";
      b.addEventListener("click",requestsent);
	<?php $num+=1;
	if($num==4){$num=0;}} ?>}
	function requestsent(event){
		var butt=event.target;
	     var id=butt.getAttribute("data-x");
		butt.classList.toggle("cancel");
		if(butt.classList.contains("cancel")){
			httpreq(id,"add",butt); 
		}
		else{
			httpreq(id,"delete",butt); 
		}
		}
		function httpreq(id,comm,self){
			var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
				var c=this.responseText;
				self.innerHTML=c;
			}
		};
       xhttp.open("GET","request.php?id="+id+"&comm="+comm,true);xhttp.send();
		}
	</script>
</head>
<body onLoad="message();">
<?php include 'header.php'; ?>
<div class="content" style="background-color:#e3e4e5;padding:75px 20px;clear:both;display:table;width:100%;min-height:100vh;">
<?php include 'sidebar.php'; ?>
<div class="content-right" style="width:83%;float:left;margin-left:16%;">
<div class="jumbotron" style="text-align:center;padding:10px;margin-bottom:10px;">
<h2><b>Add Friends</b></h2>
</div>
<div id="main">
</div></div>
</div>

<script>

var sidebar=document.getElementById('sidebar');
var content_right=document.getElementsByClassName('content-right')[0];
var searchicon=document.getElementById('searchicon');
var bars=document.getElementById('bars');
var fbicon=document.getElementById('fbicon');

function myFunction2(y) {
  if (y.matches) {console.log('300-850');
  searchicon.style.display="inline-block";
document.getElementById('searchform').style.display="none";
   sidebar.style.display="none";
   content_right.style.width="100%";
   content_right.style.marginLeft="0";
   bars.style.display="inline-block";
   fbicon.style.display="none";
  }
}
function myFunction3(z){
	if (z.matches) {console.log('855-1120');
		searchicon.style.display="none";
document.getElementById('searchform').style.display="block";
   sidebar.style.display="none";
   content_right.style.width="100%";
   content_right.style.marginLeft="0";
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
  content_right.style.width="83%";
   content_right.style.marginLeft="16%";
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