<div class="container">
<?php
session_start();
include'header.php';
$con=mysqli_connect('localhost','anbar','anbar12345','komendat');
date_default_timezone_set('Asia/Baku');
$tarix=date('Y-m-d H:i:s');
if(isset($_POST['z']))
{
	if(!empty($_POST['task']) && !empty($_POST['tarix']) && !empty($_POST['vaxt']))
	{
	$ins=mysqli_query($con,"INSERT INTO tasks(task,tarix,vaxt,created) 
		VALUES ('".$_POST['task']."','".$_POST['tarix']."','".$_POST['vaxt']."','".$tarix."')");
		if($ins==true)
		{
			echo'<div class="alert alert-success" role="alert">Melumatiniz Ugurla gonderildi</div>';
		}
		else
			{echo'Melumatiniz gonderilmedi';}
	}
	else
	{
		echo'Zehmet olmasa melumatlari tam doldurun';
	}
}
if(isset($_POST['edit']))
{
	$sec=mysqli_query($con,"SELECT * FROM tasks WHERE id='".$_POST['id']."'");
	$info=mysqli_fetch_array($sec);
	echo'
	<form method="post">
	Tapshiriq:<br>
<input type="text" name="task" value="'.$info['task'].'"><br>
Tarix:<br>
<input type="date" name="tarix" value="'.$info['tarix'].'"><br>
Vaxt:<br>
<input type="time" name="vaxt" value="'.$info['vaxt'].'"><br><br>
<button type="submit" name="update">Yenile</button>
<input type="hidden" name="id" value="'.$info['id'].'">
</form>';



}
if(!isset($_POST['edit']))
{
	echo'
	<form method="post">
	Tapshiriq:<br>
<input type="text" name="task"><br>
Tarix:<br>
<input type="date" name="tarix"><br>
Vaxt:<br>
<input type="time" name="vaxt"><br><br>
<button type="submit" name="z">Daxil et</button>
</form>
';
}
if(isset($_POST['update']))
{
	if(!empty($_POST['task']) && !empty($_POST['tarix']) && !empty($_POST['vaxt']))
	{
	$update=mysqli_query($con,"UPDATE tasks SET 
		task='".$_POST['task']."',
		tarix='".$_POST['tarix']."',
		vaxt='".$_POST['vaxt']."'
		WHERE id='".$_POST['id']."' ");
	if($update==true)
	{echo'<div class="alert alert-success" role="alert">Melumatiniz ugurla yenilendi</div>';}
	else
		{echo'<div class="alert alert-danger" role="alert">Melumatiniz yenilenmedi</div>';}
}
else 
{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa melumatlari tam doldurun</div>';}

}
if(isset($_POST['sil']))
{echo'<form method="post">
Bunu silmek istediyinzden eminsiniz?<br>
<button type="submit" name="beli" class="btn btn-info btn-sm" >Beli</button> 
<button type="submit" name="xeyr" class="btn btn-secondary btn-sm">Xeyr</button>
<input type="hidden" name="id" value="'.$_POST['id'].'">
</form>';}

if(isset($_POST['beli']))
{
	$sil=mysqli_query($con,"DELETE FROM tasks WHERE id='".$_POST['id']."' ");
	if($sil==true)
	{
		echo'<div class="alert alert-success" role="alert">Melumatiniz ugurla silindi</div>';
	}
	else
	{
		echo'<div class="alert alert-danger" role="alert">Melumatiniz silinmedi</div>';
	}
}

$sec=mysqli_query($con,"SELECT * FROM tasks");
$say=mysqli_num_rows($sec);

echo'<div class="alert alert-primary" role="alert">Toplam Tapshiriqlar: <b>'.$say.'</b> </div>';
$i=0;

echo'
<table class="table">
	<thead>
	<th>#</th>
	<th>Tapshiriq:</th>
	<th>Tarix:</th>
	<th>Vaxt</th>
	<th>Qaliq:</th>
	<th>Yaradildi:</th>
	<th></th>
</thead>
<tbody>';




while($info=mysqli_fetch_array($sec))
{
$i++;
$t=time();
$gun=strtotime($info['tarix'].''.$info['vaxt']);
$indikigun=strtotime(date('Y-m-d H:i:s'));
$ferq=$gun-$indikigun;
$deq=round($ferq/60);
$saat=round($deq/60);
$gun=round($saat/24);


if($deq>0 && $deq<60 && $saat<1)
{$qaliq=$deq.'deq';}
else
{$qaliq='Bitib';}

if($deq>59 && $saat<25)
{$qaliq=$saat.'saat';}

if($saat>24)
{$qaliq=$gun.'gun';}

echo'<tr>';
	echo'	<td>'.$i.'</td>';
	echo'	<td> '.$info['task'].'  </td>';
	echo'	<td>'.$info['tarix'].'</td>';
	echo'	<td> '.$info['vaxt'].' </td>';
	echo'	<td>  '.$qaliq.' </td>';
		echo'<td> '.$info['created'].'</td>';
		echo'<td><form method="post">
		<button type="submit" name="edit">Redakte et</button>
		<button type="submit" name="sil">Sil</button></td>
		<input type="hidden" name="id" value="'.$info['id'].'">
		</form>';
		echo'</tr>';
	echo'<tr>';
	
	}


/*
Database -> komendant

Table -> tasks
- id
- task
- tarix (Date)
- vaxt (Time)
- created (Timestamp)
- user_id

Table -> users
- id
- ad
- email
- tel
- foto
- tarix

*/

?>
</div>



<b>Toplam tapshiriqlar: </b> 5 | <b>Aktiv tapshiriqlar: </b> 2 | <b> Bitmish tapshiriqlar: </b> 3




