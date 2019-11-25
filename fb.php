<?php require 'commonfb.php';
if(isset($_SESSION['email'])){header("location:main.php");}

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{margin:0;width:100%;overflow-x:hidden;font-family:'Helvetica';}
.header{background-color:#053075;padding:15px;min-height:70px;color:white;}
.header-inner{width:80%;margin:0 auto;}
.content{background-color:#e3e4e5;min-height:90vh;}
.content1{width:80%;margin:0 auto;}
.content-left{float:left;width:40%;padding-top:50px;}
 .content-right{float:right;width:50%;padding-top:50px;}
#form-1{margin-bottom:15px;}
input[type=radio]{margin-bottom:15px;
width:20px;height:20px;vertical-align:middle;} 
@media screen and (max-width:900px){
.content-left{float:none;width:100%;}
.content-right{width:100%;float:none;}
}
.may{display:none;color:black;}
@media screen and (max-width:767px){
.form-inline .form-control{display:inline-table;width:auto;vertical-align:middle;}}

@media screen and (max-width:1178px){
.may{float:right;display:block;}
.may2{display:none;}

}

@media screen and (min-width:1179px){
.modal-backdrop{position:initial;}
}
</style>
<script>
	function message(){
		<?php $aas=$_GET['login']; ?>
		var js=<?php echo $aas ;?>;
		if(js==0){
		alert("Enter valid Email or Password");}}
	</script>
</head>
<body onload="message();">
<div class="header">
<div class="header-inner">
<h1 style="float:left;margin:0;margin-right:40px;"><b>F.R.I.E.N.D.S</b></h1>
<form class="form-inline may2" style="float:right " method="POST" action="login_sub.php"><label for="email" style="margin-right:4px;">Email </label><input type="text" class="form-control input-sm" name="email" style="margin-right:4px;"/> 
<label for="Password" style="margin-right:4px;"> Password </label><input type="password" class="form-control input-sm" name="password" style="margin-right:4px;"/>
<input type="submit" value="Login" class="btn btn-success" />
</form><div class="may"><a href="#" data-toggle="modal" data-target="#mymodal" class="btn btn-success log">LOGIN</a>
 <div class="modal fade" id="mymodal">
             <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
				    <div class="modal-header">
					   <h2>LOGIN<button type="button" class="close" data-dismiss="modal">&times;</button></h2>
					</div>
					<div class="modal-body">Don't have a account?<a href="#">Register</a><br><br>
						<form method="POST" action="login_sub.php">
						<div class="form-group"><input class="form-control input-lg" type="email" name="email" placeholder="Email"/></div>
					 <div class="form-group"><input class="form-control input-lg" type="password" name="password" placeholder="Password"/></div>
					<div class="form-group"><input class="btn btn-primary btn-lg" type="submit" value="Submit"/>
					</div>
                       </form>
					</div>
                    <div class="modal-footer">
                    <a href="#">Forgot Password?</a>
                    </div>
				</div>
			</div>
		</div>
</div>
</div></div>
<div class="content"><div class="content1"><div class="content-left"><h4><b>Friends helps you connect and share with the people in your life</b></h4><img src="network.png" style="width:100%"/></div><div class="content-right"><h1 style="margin:0;"><b>Create an account</b></h1><p>It's free and always will be.</p><input type="text" class="form-control input-lg" placeholder="First Name" style="width:50%;display:inline-block;" form="form-1" name="first"/><input type="text" class="form-control input-lg" placeholder="Surname" style="width:50%;display:inline-block;margin-bottom:15px;" form="form-1" name="last"/><form id="form-1" method="POST" action="signfb.php"><div class="form-group">
<input type="email" class="form-control input-lg" placeholder="Email" name="email"/></div><div class="form-group">
<input type="password" class="form-control input-lg" placeholder="New Password" name="password" /></div>
<div class="form-group"><h4>Birthday</h4>
<input type="date" class="form-control input-lg" value="1979-12-31" name="date"/></div>
<input type="radio" value="Male" name="gender"/><span style="font-size:20px;margin-right:30px;"> Male</span><input type="radio" value="Female" name="gender"/><span style="font-size:20px;"> Female</span><br/>
<p style="color:#b3b5b7;">By clicking signup,you agree to our Terms,Data Policy and Cookie Policy.You may receive SMS notifications from us and can opt out at any time.</p>
<input type="submit" value="Sign Up" class="btn btn-success btn-lg"/>
</form></div></div></div>
</body>
</html>
