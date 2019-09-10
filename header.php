<?php 
 $us=$_SESSION['id'];
$sql='select friends.fid,CONCAT(users.first," ",users.last) as name from friends,users where friends.fid=users.id and friends.request="waiting" and friends.friend_id='.$us ;
 $result_req=mysqli_query($con,$sql); ?>
<div class="header">
<div class="header-inner">
<span class="fa" style="font-size:30px;float:left;margin-right:30px;">&#xf082;</span>
<form class="form-inline" style="float:left;" ><input type="text" style="width:300px;color:black;border:none;padding:5px;height:30px;"/><input type="submit" class="fa" value= "&#xf002;" style="width:50px;border:none;padding:5px;color:black;height:30px;" />
</form><div class="ab">
<ul>
<li >
<a href="javascript:void(0);" class="fa fa-users" onclick="showreqbox();" class="dropbtn">
<?php if(mysqli_num_rows($result_req)!=0){?><span class="label label-pill  label-danger" style="position:absolute;right:10px;top:10px;"><?php echo mysqli_num_rows($result_req);?></span><?php }?>
</a>
<div class="reqcoll"><?php while($row=mysqli_fetch_array($result_req)){ ?>
<div class="coll"><img src="uploads\default.png" style="width:30px;" /><a href="profile.php?id=<?php echo $row['fid'] ?>"> <b><i><?php echo $row['name'] ?></i></b></a><div style="margin-top:5px">
<button type="button" class="btn btn-primary" style="padding:3px 3px;"><i>Confirm</i></button>
<button type="button" class="btn btn-warning" style="padding:3px 3px;"><i>Decline</i></button>
</div>
  </div><?php } ?></div>
</li>
<li>
<a href="javascript:void(0);" class="fa">&#xf0e0;<span class="label label-pill  label-danger" style="position:relative;right:10px;top:10px;">5</span></a>
</li>
<li>
<a href="javascript:void(0);" class="fa fa-newspaper-o"><span class="label label-pill  label-danger" style="position:relative;right:10px;top:10px;">5</span></a>
</li></ul>
</div>
</div></div>
<script>
function showreqbox(){document.getElementsByClassName('reqcoll')[0].classList.toggle("show");}
/*window.onclick=function(event){
	if(!event.target.matches('.dropbtn')){
		var a=document.getElementsByClassName('reqcoll')[0];
if(a.classList.contains('show')){
	a.classList.remove('show');
}
	}
} */
</script>
