<?php   
require 'commonfb.php';
$data=$_GET['data'];
$sql="select CONCAT(users.first,' ',users.last) as name,stories.post_img from stories,users where stories.userid=users.id and stories.userid=".$data;
$result=mysqli_query($con,$sql);$json_array=array();
while($row=mysqli_fetch_assoc($result)){
$json_array[]=$row;
}
print_r(json_encode($json_array));
?>