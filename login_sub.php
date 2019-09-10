<?php 
require 'commonfb.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql="SELECT id,email FROM users WHERE email='$email' AND password='$password';";  
$query=mysqli_query($con,$sql);
if(!$query){die("connection failed:".mysqli_error());}
if(mysqli_num_rows($query)==0){
header('location:fb.php?login=0');
}
else{
	$row=mysqli_fetch_array($query);
	$_SESSION['id']= $row['id'];
	$_SESSION['email']= $row['email'];
	$sq="INSERT INTO online(userid) values(".$_SESSION['id'].")";
	mysqli_query($con,$sq);
	header('Location:main.php');
}}
?>