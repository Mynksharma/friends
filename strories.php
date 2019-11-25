<?php 
require 'commonfb.php';
$us=$_SESSION['id'];
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .header{background-color:#053075;padding:10px;min-height:70px;color:white;position:fixed;z-index:1030;top:0;right:0;left:0;}
.header-inner{width:85%;margin:0 auto;padding:10px;}
.ab ul{list-style-type:none;margin:0;padding:0;}
.ab li{float:right;position:relative;}
.ab li a{text-decoration:none;color:white;padding-left:20px;font-size:20px;padding-right:20px;position:relative;display:inline-block;}
.ab li .reqcoll{display:none;position:absolute;background-color:white;min-height:50px;min-width:200px;z-index:1;border-radius:5px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);top:40px;right:5px;
}
.ab li .reqcoll .coll{padding:5px 5px;border-bottom:1px solid #F2EDEC;}
.reqcoll div a{color:black;font-size:small;}
    .left_portion{width:15%;height:100vh;background-color:white;padding:75px 10px;float:left;}
    .stories_ul{padding:0;list-style-type:none;}
    .right_portion .back{filter: blur(2px);height: 100%;width:100%;}
    .middle_portion{position:absolute;height:70%;width:30%;border-radius:5px;margin:auto;top:0;bottom:0;right:0;left:0;background-color:black;}
  .stories_ul li:hover{background-color:rgba(192,192,192,0.3);cursor:pointer;}
  .stories_ul li{padding:10px;}
  .right{display:block;position:absolute;margin:auto;top:0;bottom:0;left:0;right:-420px;width:48px;height:48px;}
  .left{display:block;position:absolute;margin:auto;top:0;bottom:0;left:-420px;right:0px;width:48px;height:48px;}
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
            var p_img=document.getElementById("p_img");
            s_name.innerHTML=parse[0]['name'];
           // s_img.setAttribute('src',"uploads\\"+parse[0]['img']);
           // p_img.innerHTML=parse[0]['pimg'];
            
        }
    };xhttp.open("GET","change_story.php?data="+classname,true);xhttp.send();
    }
    window.onload=function(){
        console.log("hello")
        <?php
		 $sq="select CONCAT(users.first,' ',users.last)as name,users.id,stories.update_time from stories,users,friends where stories.userid=users.id and friends.friend_id=stories.userid and friends.request='accept' and friends.fid=".$us;
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
  
      
    </script>
</head>
<body>
    
<?php include 'header.php'; ?>
<div class="left_portion">
<h2 style="margin-top:0;margin-bottom:20px"><b>Stories</b></h2>
<div>
<h5 style="margin-top:0;margin-bottom:10px"><b>Your Story</b></h4>
<div style="padding:5px;margin-bottom:10px">
<i class="material-icons" style="vertical-align:middle;color:blue;font-size:40px;">&#xe148;</i>
<span style="margin-left:5px;"><b>Add your story</b></span></div>
</div>
<div>
<h5 style="margin-top:0;margin-bottom:10px"><b>All Stories</b></h4>
<ul class="stories_ul">
</ul>
</div>
</div>
<div class="right_portion" style="float:left;width:85%;height:100vh;position:relative;padding-top:70px;background-color:#ABA7A6">

<div class="middle_portion">
<i class="fa fa-arrow-circle-right right" style="font-size:48px;color:black;" data-x="" onClick="change(event);"></i>
<i class="fa fa-arrow-circle-left left" style="font-size:48px;color:black;visibility:hidden" data-x="" onClick="change(event);"></i>
<div class="progress_bar_outer"><div class="progress_bar_inner"></div></div>
<div class="name_sec"><img src="uploads/default.png" id="s_img"/><b id="s_name"></b></div>
<div class="story_post"><img src="uploads/waterfall.jpg" id="p_img"/></div>
</div></div>

</body>
</html>