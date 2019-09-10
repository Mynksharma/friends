<?php
require 'commonfb.php';
$rec=array();
$id=18;$rec=$_GET['rec'];
$rec=json_decode($rec);
$sql="select postid,status,update_date from posts where userid='$id' order by update_date DESC";
$result=mysqli_query($con,$sql);$json_array=array();
while($row=mysqli_fetch_assoc($result)){
$json_array[]=$row;
}
$c=count($json_array);
for($d=0;$d<$c;$d++){  
   $o= strtotime( $json_array[$d]["update_date"]);
    $json_array[$d]["update_date"]=date("D-M-Y",$o);
}
print_r(json_encode($json_array));

    ?>
