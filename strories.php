<?php 
require 'commonfb.php';$name=$_SESSION['email'];
$us=$_SESSION['id'];
$sql="select first,last from users where email='$name';";
$result=mysqli_query ($con,$sql);$row=mysqli_fetch_array($result);
$namf=$row['first'];
$naml=$row['last'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=0.83,user-scalable=no">
    <style>
    body{background-color:#ABA7A6;}
    .header{background-color:purple;padding:10px;min-height:70px;color:white;position:fixed;z-index:1030;top:0;right:0;left:0;}
.header-inner{width:85%;margin:0 auto;padding:10px;}
.ab ul{list-style-type:none;margin:0;padding:0;float:right;}
.ab{float:right;}.ab li{float:right;position:relative;}
.ab li a,#searchicon{text-decoration:none;color:white;padding-left:20px;font-size:20px;padding-right:20px;position:relative;display:inline-block;}
.ab li .reqcoll{display:none;position:absolute;background-color:white;min-height:50px;min-width:200px;z-index:1;border-radius:5px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);top:40px;right:5px;
}
.right_portion .back{filter: blur(2px);height: 100%;width:100%;}
.ab li .reqcoll .coll{padding:5px 5px;border-bottom:1px solid #F2EDEC;}
.reqcoll div a{color:black;font-size:small;}
.content-left{width:15%;}
.content-left ul{list-style-type:none;margin-left:-40px;}
.content-left li{padding:10px;margin-bottom:2px;}
.content-left li:hover{background-color:rgba(255,255,255,0.5);}
.content-left li a{text-decoration:none;color:black;}
.content-left li:hover a{color:green;}
#sidebar{min-width:160px;position:fixed;z-index:5}
.ab li .reqcoll .coll{padding:5px 5px;border-bottom:1px solid #F2EDEC;}
    .left_portion{width:15%;height:100vh;background-color:white;padding:75px 10px;float:left;}
    .stories_ul{padding:0;list-style-type:none;}
    .middle_portion{position:absolute;height:400px;width:300px;min-width:200px;border-radius:5px;margin:auto;top:0;bottom:0;right:0;left:0;background-color:black;}
  .stories_ul li:hover{background-color:rgba(192,192,192,0.3);cursor:pointer;}
  .stories_ul li{padding:10px;}
  .right{display:block;position:relative;left:310px;top:200px;width:48px;height:48px;}
  .left{display:block;position:relative;left:-58px;top:152px;width:48px;height:48px;}
  .progress_bar_outer{position:absolute;height:4px;width:90%;margin:auto;border-radius:5px;background-color:grey;top:20px;left:0;right:0;;}
  .progress_bar_inner{height:4px;border-radius:5px;background-color:white}
  .name_sec{position:absolute;margin:auto;top:40px;left:0;right:0;width:90%;color:white;}
  .name_sec img{height:35px;padding:3px;border-radius:50%;vertical-align:middle;width:35px;}
.story_post img{position:absolute;margin:auto;top:0;bottom:0;width:95%;max-height:100%;left:0;right:0}
      </style>
    <script type="text/javascript">
     function change(id){
         var classname=id.target.getAttribute("data-x");
         var doc=document.getElementsByClassName("stories_ul")[0];
         var left= document.getElementsByClassName("left")[0];
         var right=document.getElementsByClassName("right")[0];
         if(doc.firstElementChild.getAttribute('data-x')==classname){
            var next= doc.firstElementChild.nextElementSibling.getAttribute("data-x");
              left.style.visibility="hidden";
               right.style.visibility="visible";
               right.setAttribute("data-x",next);
         }
        else if(doc.lastElementChild.getAttribute('data-x')==classname){
            var previous=doc.lastElementChild.previousElementSibling.getAttribute("data-x");
            right.style.visibility="hidden";
            left.style.visibility="visible";
           left.setAttribute("data-x",previous);
         }
         else{
             for(i of doc.children){
             if(i.getAttribute('data-x')==classname){
                var next= i.nextElementSibling.getAttribute("data-x");
                 var previous=i.previousElementSibling.getAttribute("data-x");
                left.style.visibility="visible";
                right.style.visibility="visible";
               left.setAttribute("data-x",previous);
                right.setAttribute("data-x",next);
                break;
             }
         }
         }
         if(document.getElementById('right-portion').style.display=="none"){
         document.getElementsByClassName('left_portion')[0].style.display="none";
          document.getElementById('right-portion').style.display="block";
          document.getElementById('right-portion').style.width="100%";
         }
         //console.log(id.target.getAttribute("class"));
     /*   id=id.target.getAttribute("class");
  
        if(id.target.){
         var next=document.getElementsByClassName(id)[0].nextElementSibling.getAttribute("data-x");
         document.getElementsByClassName("next")[0].style.visibility="visible";
         document.getElementsByClassName("next")[0].setAttribute("id",next);
        }
         else{ document.getElementsByClassName("next")[0].style.visibility="hidden";}

         if(document.getElementsByClassName(id)[0].previousElementSibling.getAttribute("class")){
            var prev=document.getElementsByClassName(id)[0].previousElementSibling.getAttribute("class");
            document.getElementsByClassName("prev")[0].style.visibility="visible";
            document.getElementsByClassName("prev")[0].setAttribute("id",prev);

         }
         else{
            document.getElementsByClassName("prev")[0].style.visibility="hidden";
         }
         */
        var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            var data=this.responseText;
			var parse=JSON.parse(data);
            var s_name=document.getElementById("s_name");
            var s_img=document.getElementById("s_img");
            var p_img=document.getElementById("p_img");console.log(s_name);
            s_name.innerHTML=parse[0]['name'];
           // s_img.setAttribute('src',"uploads\\"+parse[0]['img']);
           p_img.setAttribute('src',"stories_upload\\"+parse[0]['post_img']);
            
        }
    };xhttp.open("GET","change_story.php?data="+classname,true);xhttp.send();
    }
    window.onload=function(){
        console.log("hello")
        <?php
		 $sq="select CONCAT(users.first,' ',users.last) as name,users.id,stories.update_time from stories,users,friends where stories.userid=users.id and friends.friend_id=stories.userid and friends.request='accept' and friends.fid=".$us;
		$resul=mysqli_query($con,$sq);
		while($r=mysqli_fetch_array($resul)){?>
           var a=document.getElementsByClassName("stories_ul")[0];
           var li=document.createElement("li");
            li.setAttribute("data-x","<?php echo $r['id']; ?>");
            li.addEventListener("click",change,false); 
           var img=document.createElement("img");
		   img.setAttribute('src',"uploads\\default.png");
		  img.style.height="35px";
          img.style.borderRadius="50%";
          img.style.border="2px solid blue";
         img.style.padding="3px";
          img.style.verticalAlign="middle";
          img.style.marginRight="5px";
          var node=document.createTextNode("<?php echo " ".$r['name'] ?>");
          li.style.fontWeight="bold";
          li.appendChild(img);
          li.appendChild(node);
        a.appendChild(li);<?php } ?>
        document.getElementById("s_name").innerHTML=" "+document.getElementsByClassName("stories_ul")[0].firstElementChild.childNodes[1].nodeValue;
        document.getElementsByClassName("right")[0].setAttribute("data-x",document.getElementsByClassName("stories_ul")[0].firstElementChild.nextElementSibling.getAttribute("data-x"));//repeat();
    }
  function repeat(){
    var elem = document.getElementsByClassName("progress_bar_inner")[0];   
         var width = 1;
        var id = setInterval(frame,50);
        function frame() {
           if (width >= 100){
            clearInterval(id);
            document.getElementsByClassName("right")[0].click();
            repeat();
           }
            else {
               width++; 
               elem.style.width = width + '%'; 
                  }
         }
  }
  
  function deletetempimg(){
		document.getElementById("upload").disabled=true;
		var a=document.getElementById("imgform");
	a.reset();
	var image=document.getElementById("image");
	image.src="uploads\\default.png";
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
    </script>
</head>
<body>
<div class="modal " id="mymodal">
             <div class="modal-sm modal-dialog modal-dialog-centered">
                <div class="modal-content">
				    <div class="modal-header">
					   <h2>Add story
						 <button type="button" class="close" data-dismiss="modal" onclick="deletetempimg();">&times;
							</button></h2>
					</div>
					<div class="modal-body">
					   <img src="uploads\default.png" style="display:block;margin:auto;" height="100px" id="image"><br><br>
                       <form action="upload.php?src=story" method="POST" enctype="multipart/form-data" id="imgform">
<input type="file" name="file" id="files" style="display:none;"/>
<input type="submit" name="submit" id="up" style="display:none;" /></form>
						<button class="btn btn-primary bta" onclick="choose();" style="margin-right:20px;">Choose</button>
					<button class="btn btn-primary bta" onclick="upload();"  id="upload" disabled>Upload</button>
					</div>
				</div>
			</div>
		</div> 
<?php include 'header.php'; ?>
<div class="left_portion">
<?php include 'sidebar.php'; ?>
<h2 style="margin-top:0;margin-bottom:20px"><b>Stories</b></h2>
<div>
<h5 style="margin-top:0;margin-bottom:10px"><b>Your Story</b></h4>
<div style="padding:5px;margin-bottom:10px;cursor:pointer" data-toggle="modal" data-target="#mymodal">         
<i class="material-icons" style="vertical-align:middle;color:blue;font-size:40px;">&#xe148;</i>
<span style="margin-left:5px;"><b>Add your story</b></span></div>
</div>
<div>
<h5 style="margin-top:0;margin-bottom:10px"><b>All Stories</b></h4>
<ul class="stories_ul">
</ul>
</div>
</div>
<div style="float:left;width:75%;height:100vh;position:relative;padding-top:70px;" id="right-portion">
<div class="middle_portion">
<i class="fa fa-arrow-circle-right right" style="font-size:48px;color:black;" data-x="" onClick="change(event);"></i>
<i class="fa fa-arrow-circle-left left" style="font-size:48px;color:black;visibility:hidden" data-x="" onClick="change(event);"></i>
<div class="progress_bar_outer"><div class="progress_bar_inner"></div></div>
<div class="name_sec"><img src="uploads/default.png" id="s_img"/><b id="s_name"></b></div>
<div class="story_post"><img src="uploads/waterfall.jpg" id="p_img"/></div>
</div></div>
<script>

var left_portion=document.getElementsByClassName('left_portion')[0];
var searchicon=document.getElementById('searchicon');
var bars=document.getElementById('bars');
var fbicon=document.getElementById('fbicon');
var sidebar=document.getElementById('sidebar');
var right_portion=document.getElementById('right-portion');
function myFunction2(y) {
  if (y.matches) {console.log('300-850');
  searchicon.style.display="inline-block";
document.getElementById('searchform').style.display="none";
sidebar.style.display="none";
right_portion.style.display="none";
   left_portion.style.width="100%";
   left_portion.style.minWidth="200px";
   bars.style.display="inline-block";
   fbicon.style.display="none";
  }
}
function myFunction3(z){
	if (z.matches) {console.log('855-1120');
		searchicon.style.display="none";
document.getElementById('searchform').style.display="block";
  left_portion.style.width="15%";
  sidebar.style.display="none";
  right_portion.style.display="block";
  right_portion.style.width="75%";
  left_portion.style.minWidth="200px";
   bars.style.display="inline-block";
   fbicon.style.display="none";
  }
}
function myFunction4(w){
	if (w.matches){
		console.log('1121-');
		searchicon.style.display="none";
document.getElementById('searchform').style.display="block";
sidebar.style.display="none";
  left_portion.style.minWidth="200px";
  right_portion.style.display="block";
  right_portion.style.width="75%";
  left_portion.style.width="15%";
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