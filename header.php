<?php 
 $us=$_SESSION['id'];
$sql='select friends.fid,CONCAT(users.first," ",users.last) as name from friends,users where friends.fid=users.id and friends.request="waiting" and friends.friend_id='.$us ;
 $result_req=mysqli_query($con,$sql);
 $sql1="select count(chats.id) as msgcount from chats where status='0' and friend_id='$us'";
 $result_msg=mysqli_query($con,$sql1);$r=mysqli_fetch_array($result_msg);
 ?>
<div class="header" style="min-width:400px;"><div class="header-inner"><span class="fa" id='bars' style="font-size:30px;float:left;margin-right:20px;cursor:pointer;" onClick="btntosidebar();">&#xf039;</span><span class="fa" id="fbicon" style="font-size:30px;float:left;margin-right:20px;">&#xf082;</span><form class="form-inline" style="float:left;" id="searchform" ><input type="text" style="width:300px;color:black;border:none;padding:5px;height:30px;"/><input type="submit" class="fa" value= "&#xf002;" style="width:50px;border:none;padding:5px;color:black;height:30px;" /></form><div class="ab"><ul><li><a href="javascript:void(0);" class="fa fa-users" onclick="showreqbox();" class="dropbtn"><?php if(mysqli_num_rows($result_req)!=0){?><span class="label label-pill  label-danger lb" style="position:absolute;right:10px;top:10px;"><?php echo mysqli_num_rows($result_req);?></span><?php }?></a><div class="reqcoll"><?php while($row=mysqli_fetch_array($result_req)){ ?><div class="coll" data-x="<?php echo $row['fid']; ?>"><img src="static_images\default.png" style="width:30px;" /><a href="profile.php?id=<?php echo $row['fid'] ?>"> <b><i><?php echo $row['name'] ?></i></b></a><div style="margin-top:5px"><button type="button" class="btn btn-primary" style="padding:3px 3px;margin-right:5px;" data-x="<?php echo $row['fid'] ?>" onClick="request_approval(this,'confirm');"><i>Confirm</i></button><button type="button" class="btn btn-warning" style="padding:3px 3px;" data-x="<?php echo $row['fid'] ?>" onClick="request_approval(this,'decline');"><i>Decline</i></button></div></div><?php } ?></div></li><li><a href="javascript:void(0);" class="fa" onclick="showmsgbox();">&#xf0e0;<?php if($r['msgcount']!=0){?><span class="label label-pill  label-danger mb" style="position:relative;right:10px;top:10px;"><?php echo $r['msgcount']; ?></span><?php } ?></a><div class="msgcol" style="display:none;position:absolute;background-color:white;min-height:50px;min-width:300px;z-index:1;border-radius:5px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);top:40px;right:5px;color:black;"></div></li><li><a href="javascript:void(0);" class="fa fa-newspaper-o" onclick="shownotifybox();"><span class="label label-pill  label-danger" style="position:relative;right:10px;top:10px;"></span></a></li><li><i style="float:right;" class="fa" id="searchicon">&#xf002;</i></li></ul></div></div></div><script>
function showreqbox(){var callist=document.getElementsByClassName('reqcoll')[0];callist.classList.toggle("show");
if(callist.classList.contains("show")){
	if(!callist.children.length){
		callist.innerHTML="No new requests";
		callist.style.textAlign="center";
		callist.style.fontWeight="bold";
		callist.style.fontStyle="italic";
		callist.style.color="black";
		callist.style.paddingTop="10px";	}
		document.getElementsByClassName("lb")[0].style.display="none";
}
}
/*window.onclick=function(event){
	if(!event.target.matches('.dropbtn')){
		var a=document.getElementsByClassName('reqcoll')[0];
if(a.classList.contains('show')){
	a.classList.remove('show');
}
	}
} */
function btntosidebar(){
	let side=document.getElementById('sidebar');
    if(side.style.display==="none") side.style.display="initial";
	else  side.style.display="none";
}
function showmsgbox(){
	var callist=document.getElementsByClassName('msgcol')[0];callist.classList.toggle("show");
	if(!callist.classList.contains('show')){
		if(callist.children){
			while(callist.firstChild){
					callist.removeChild(callist.firstChild);
				}
		}
	}
	else{
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
             var data=this.responseText;
			 var c=JSON.parse(data);
			 c.push({'id':Number.MIN_VALUE});
			 console.log(c);
			 
	if(c.length==1){console.log("no message");
		callist.innerHTML="No new messages";
		callist.style.textAlign="center";
		callist.style.fontWeight="bold";
		callist.style.fontStyle="italic";
		callist.style.color="black";
		callist.style.paddingTop="10px";document.getElementsByClassName("mb")[0].style.display="none";}
else{document.getElementsByClassName("mb")[0].style.display="none";
c.sort((a,b)=>{return b['id']-a['id']});
var count=1;var b=[]; 
for(var i=1;i<c.length;i++){
if(c[i]['id']==c[i-1]['id']){
	count++;}
	else{c[i-1].count=count;b.push(c[i-1]);count=1;}        
	            }
     for(i of b){
		 var block=document.createElement("div");
		 (function(block,id,name){
			 block.addEventListener("click",function(){console.log(i['name']);
              chat(id,name);
			  showmsgbox();
			  messageseen(id);
		});
		}(block,i['id'],i['name']));
		 block.style.padding="5px 5px";
		 block.style.border="1px solid #F2EDEC";
		 block.setAttribute("data-x",i['id']);
		 callist.appendChild(block);
		 var img=document.createElement("img");
		 img.setAttribute("src","static_images\\default.png");
		 img.style.width="30px";
		 block.appendChild(img);
		 var content=document.createElement("span");
		 block.appendChild(content);
		 var conmsg=document.createTextNode(i['name']+"  ");
		 content.appendChild(conmsg);
		 var contt=document.createElement("span");
		 var conmsg=document.createTextNode("  "+i['count']+" new messages");
		 contt.appendChild(conmsg);
		 content.appendChild(contt);
		 contt.style.color="blue";contt.style.marginLeft="10px";
		 content.style.cursor="pointer";
		 contt.style.fontWeight="normal";
		 contt.style.fontSize="14px";
		 content.style.textAlign="center";
		content.style.fontWeight="bold";
		content.style.fontStyle="italic";
		
	 }
}
		}
	}
	xhttp.open("GET","msgupdates.php",true); xhttp.send();}
}
function request_approval(elem,what){
	var xhttp=new XMLHttpRequest();
	var i=elem.getAttribute("data-x");
		xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
			var parent=document.getElementsByClassName("reqcoll")[0];
			var child=document.getElementsByClassName("reqcoll")[0].children;
			console.log(child);
			for(let j of child){
				if(j.getAttribute("data-x")===i){
					parent.removeChild(j);break;
				}
			}
			var lb=document.getElementsByClassName("lb")[0].innerHTML;console.log(lb);
		    var lbnum=parseInt(lb,10);console.log(lbnum);
			lbnum=lbnum-1;
			lb=lbnum.toString();
			if(!parent.children.length){
		parent.innerHTML="No new requests";
		parent.style.textAlign="center";
		parent.style.fontWeight="bold";
		parent.style.fontStyle="italic";
		parent.style.color="black";
		parent.style.paddingTop="10px";	}
}
			}
			xhttp.open("GET","request_approval.php?id="+i+"&what="+what,true);xhttp.send();

		};
		function messageseen(userid){
			var xhttp=new XMLHttpRequest();
			xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){}
		}
		xhttp.open("GET","messageseen.php?id="+userid,true);xhttp.send();
		}
</script>
