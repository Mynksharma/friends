<?php
require 'commonfb.php' ;
$a=$_POST['first'];
$c=$_POST['last'];
$d=md5($_POST['password']);
$e=$_POST['email'];
$f=$_POST['date'];
$g=$_POST['gender'];
$sql="SELECT id FROM users WHERE email='$e'";
$row=mysqli_query($con,$sql);
if(mysqli_num_rows($row)>0){
header('Location:fb.php?sign=0');
}
else{
$sql="INSERT INTO users(email,first,last,password,date,gender) VALUES ('$e','$a','$c','$d','$f','$g')";
$query=mysqli_query($con,$sql);$pr=mysqli_insert_id($con);
$sq="SELECT email FROM users WHERE id='$pr'";$quer=mysqli_query($con,$sq);
$row=mysqli_fetch_array($quer);
$_SESSION['id']=$pr;
$_SESSION['email']=$row['email'];
$sq="INSERT INTO online(userid) values(".$pr.")";
header("Location:main.php?$a");}
?>
