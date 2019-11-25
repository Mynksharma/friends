<?php 
require 'commonfb.php';$id=$_SESSION['id'];
if(isset($_POST['submit'])){
    $file=$_FILES['file'];
    $fileName=$_FILES['file']['name'];
    $fileTmpname=$_FILES['file']['tmp_name'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fleType=$_FILES['file']['type'];
$fileExt=explode('.',$fileName);
$fileActualExt=strtolower(end($fileExt));
$allowed=array('jpg','jpeg','png');
if(in_array($fileActualExt,$allowed)){
    $fileNameNew=uniqid('mayank',true).".".$fileActualExt;
    $fileDestination='uploads/'.$fileNameNew;
    move_uploaded_file($fileTmpname,$fileDestination);
    $sql="insert into posts(userid,imgstatus,update_date) values('$id','$fileNameNew',NOW())";
mysqli_query($con,$sql);
    header("location:main.php");
}
}?>