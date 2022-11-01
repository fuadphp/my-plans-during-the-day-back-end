<?php
session_start();

error_reporting(0);
if(isset($_SESSION['email']) && isset($_SESSION['parol']))
{echo'<meta http-equiv="refresh" content="0; URL=tasks.php"> '; exit;}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Anbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="">Haqqimizda</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="">Elaqe</a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post">
      <input class="form-control mr-sm-2" name="email" type="search" placeholder="email">
      <input class="form-control mr-sm-2" name="parol" type="password" placeholder="parol">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="daxil">Daxil ol</button>&nbsp; 
      

    </form>
  </div>
</nav><br><br><br>
<div class="container">






<?php 



$con=mysqli_connect('localhost','anbar','anbar12345','komendat');
$tarix=date('Y-m-d H:i:s');

/*

Table - users
-id
-ad
-soyad
-telefon
-email
-parol
-tarix



*/
if(isset($_POST['daxil']))
{
	$email=trim($_POST['email']);
	$email=strip_tags($email);
	$email=mysqli_real_escape_string($con,$email);
	$email=htmlspecialchars($email);

	$parol=trim($_POST['parol']);
	$parol=strip_tags($parol);
	$parol=htmlspecialchars($parol);
	$parol=mysqli_real_escape_string($con,$parol);
	

	$yoxla= mysqli_query($con, "SELECT * FROM users WHERE email='".$email."' AND parol='".$parol."' ");
	if(mysqli_num_rows($yoxla)>0)
	{
$info=mysqli_fetch_array($yoxla);
$_SESSION['user_id'] = $info['id'];
$_SESSION['ad'] = $info['ad'];
$_SESSION['soyad'] = $info['soyad'];
$_SESSION['telefon'] = $info['tel'];
$_SESSION['email'] = $info['email'];
$_SESSION['parol'] = $info['parol'];
echo'<meta http-equiv="refresh" content="0; URL=tasks.php>" '; exit;
}
else
{echo'<div class="alert alert-danger" role="alert"> Daxil etdiyiniz şifrə və parol yalnışdır!</div>';}

}


if(!isset($_POST['z']))
{
	echo'
	<div class="alert alert-primary" role="alert">
<form method="post">
Ad:
<input type="text" name="ad" class="form-control"  value="'.$_POST['ad'].'">
Soyad:
<input type="text" name="soyad" class="form-control" value="'.$_POST['soyad'].'">
Telefon:
<input type="text" name="telefon" class="form-control" value="'.$_POST['tel'].'">
Email:
<input type="text" name="email" class="form-control" value="'.$_POST['email'].'">

Parol:
<input type="password" name="parol" class="form-control" value="'.$_POST['parol'].'">
Təkrar parol:
<input type="password" name="tparol" class="form-control" value="'.$_POST['tparol'].'">
<button type="submit" name="r1"  class="btn btn-primary">Qeydiyyatdan Keç</button>


</form>
</div>';
}
if(isset($_POST['r1']))

{
	if($_POST['parol']==$_POST['tparol'])
	{

	$ad=trim($_POST['ad']);
	$ad=strip_tags($ad);
	$ad=htmlspecialchars($ad);
	$ad=mysqli_real_escape_string($con,$ad);

	$soyad=trim($_POST['soyad']);
	$soyad=strip_tags($soyad);
	$soyad=htmlspecialchars($soyad);
	$soyad=mysqli_real_escape_string($con,$soyad);

	$tel=trim($_POST['tel']);
	$tel=strip_tags($tel);
	$tel=htmlspecialchars($tel);
	$tel=mysqli_real_escape_string($con,$tel);

	$email=trim($_POST['email']);
	$email=strip_tags($email);
	$email=mysqli_real_escape_string($con,$email);
	$email=htmlspecialchars($email);

	$parol=trim($_POST['parol']);
	$parol=strip_tags($parol);
	$parol=htmlspecialchars($parol);
	$parol=mysqli_real_escape_string($con,$parol);
	$tparol=trim($_POST['tparol']);
	$tparol=strip_tags($tparol);
	$tparol=htmlspecialchars($tparol);
	$tparol=mysqli_real_escape_string($con,$tparol);

	if(!empty($ad)&& !empty($soyad) && !empty($tel) && !empty($email) && !empty($parol) && !empty($_POST['tparol']))
	{

		$yoxla=mysqli_query($con,"SELECT * FROM users WHERE tel='".$tel."' OR email='".$email."' ");
		if(mysqli_num_rows($yoxla)==0)
		{
		$ins=mysqli_query($con, "INSERT INTO users(ad,soyad,email,tel,parol,tarix) 
			VALUES ('".$ad."','".$soyad."','".$tel."','".$email."','".$parol."','".$tarix."')");
		if($ins==true)
		{
			echo'<div class="alert alert-success" role="alert">Melumatiniz Ugurla Gonderildi</div>';
		}
		else
			{echo'<div class="alert alert-danger" role="alert"> Melumatiniz Gonderilmedi</div>';}
	}
	else 
		{echo'<div class="alert alert-danger" role="alert"> Bu istifadəçi artıq bazada mövcuddur!</div>';}

	}
	else
	{
		echo'<div class="alert alert-warning" role="alert"> Zəhmət olmasa məlumatları tam doldurun!</div>';
	}
	
}
else
	{
		echo'<div class="alert alert-warning" role="alert"> Daxil etdiyiniz Parollar üst üstə düşmür!</div>';
	}
}


?>
</div>



