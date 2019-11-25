<html>
 <head>
 <title>
 </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<style>.content{background-color:#e3e4e5;width:auto;
padding:75px 20px;clear:both;display:table;width:100%;min-height:100vh;}
.cont-center{width:80%;}
.header{background-color:#053075;padding:10px;min-height:70px;color:white;position:fixed;z-index:1030;top:0;right:0;left:0;}
.header-inner{width:85%;margin:0 auto;padding:10px;}
.ab a{float:right;text-decoration:none;color:white;padding-left:20px;font-size:20px;padding-right:20px;}
.content-left{width:15%;}
.content-left ul{list-style-type:none;margin-left:-40px;}
.content-left li{padding:10px;margin-bottom:2px;}
.content-left li:hover{background-color:rgba(255,255,255,0.5);}
.content-left li a{text-decoration:none;color:black;}
.content-left li:hover a{color:green;}
.cont-center{width:70%;float:left;margin-left:16%;}
.conback{height:50vh;border-radius:5px;}
.thu{margin-left:30px;height:120px;width:120px;position:absolute;bottom:-20px;border:2px solid grey;margin-bottom:0px;z-index:2;}
.profileDet li a{color:blue;font-weight:bold;text-decoration:none;}
.profileDet li{border:none;padding:10px 25px;text-align:center;display:inline-block;height:100%;width:130px;margin:0px;}
.profileDet li:hover{background-color:rgba(211,211,211,0.5)}
.profileDet li a:hover{color:green}
.intro{margin-top:5px;float:left;width:40%;background-color:white;min-height:300px;}
#posts{float:left;width:57%;min-height:300px;margin-top:5px;margin-left:3%;}
.intro ul li{padding:5px;}
    </style>
<script>var record= new Array();
       var parec=JSON.stringify(record);
    function ajaxcall(){
        var xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
                var data=this.responseText;
			var decode=JSON.parse(data);
			var y=0;
		      while(y<3){console.log(y);
			var dive=document.getElementById("post");
		var d=document.createElement("div");
		d.classList.add("panel");
		d.classList.add("panel-default");
		dive.appendChild(d);
		var d1=document.createElement("div");
		d1.classList.add("panel-heading");
		d.appendChild(d1);
		var img=document.createElement("img");
		img.setAttribute('src',"uploads\\default.png");
		img.style.height="25px";img.style.borderRadius="50%";
		var node=document.createTextNode("jklfajg");
		d1.appendChild(img);
		d1.appendChild(node);
		d1.style.fontWeight="bold";
		var d2=document.createElement("div");
		d2.classList.add("panel-body");
		d.appendChild(d2);var time=document.createElement("p");
		time.style.color="grey";
		time.style.fontSize="13px";
	   var node=document.createTextNode(decode[y]["update_date"]);
	   time.appendChild(node);d2.appendChild(time);
		var node=document.createTextNode(decode[y]['status']);
		d2.style.fontStyle="italic";d2.style.fontSize="20px";
		d2.appendChild(node);
		var d3=document.createElement("div");
		d3.classList.add("panel-footer");
		d.appendChild(d3);
		var b=document.createElement("button");
		d3.appendChild(b);
		b.classList.add("btn");b.style.border="none";
		b.classList.add("btn-default");var like=document.createElement("i");like.classList.add("fa");like.classList.add("fa-thumbs-o-up");b.appendChild(like);
		var node=document.createTextNode(" Like");
		b.appendChild(node);b.style.fontWeight="bold";	
		b.style.marginRight="10px";
		var c=document.createElement("button");
		d3.appendChild(c);c.style.border="none";
		c.classList.add("btn");
		c.classList.add("btn-default");var comment=document.createElement("i");comment.classList.add("fa");comment.classList.add("fa-thumbs-o-up");
        c.appendChild(comment);
		var node=document.createTextNode(" Comment");
        c.appendChild(node);c.style.fontWeight="bold";y++;
		
    }}
        };
        xhttp.open("GET","changes.php?id=18&rec=parec",true);xhttp.send();
    }ajaxcall();
//setInterval(ajaxcall,3*1000);
</script></head>
<body>
<div id="post"></div>
</body></html>