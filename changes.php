<?php
require 'commonfb.php';
$rec=array();
$id=18;/*$rec=$_GET['rec'];*/
//$rec=json_decode($rec);
$sql="select friend_id from friends where fid=20 and request='waiting'";
$result=mysqli_query($con,$sql);$json_array=array();$z=0;
while($row=mysqli_fetch_assoc($result)){
$json_array[]=$row['friend_id'];
}
//print_r(count($json_array[0]));
print_r($json_array);
print_r(array_search(0,$json_array));
//$json_array[0]['lll']=555;
//print_r($json_array[0]);
//print_r(array_search(38,$json_array));
/*$c=count($json_array);
for($d=0;$d<$c;$d++){  
   $o= strtotime( $json_array[$d]["update_date"]);
    $json_array[$d]["update_date"]=date("D-M-Y",$o);
}
print_r(json_encode($json_array)); */

    ?>
