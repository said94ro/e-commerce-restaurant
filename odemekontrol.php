
<?php include('header.php'); ?>

<?php include('topbar.php'); ?>

<?php include('menu.php'); ?>

<?php
#zindex display flex

$siparis_isim=$_POST['siparis_isim'];
$siparis_tel=$_POST['siparis_tel'];
$siparis_email=$_POST['siparis_email'];
$siparis_il=$_POST['siparis_sehir'];
$siparis_ilce=$_POST['siparis_ilce'];
$siparis_adresozet=$_POST['siparis_adresozet'];
$siparis_adres=$_POST['siparis_adres'];

$siparis_id=$_POST['siparis_id'];
$siparis_statu=1;





$sql="UPDATE sepetsiparis SET siparis_isim=:siparis_isim,siparis_tel=:siparis_tel,siparis_email=:siparis_email,siparis_il=:siparis_il,siparis_ilce=:siparis_ilce,siparis_adresozet=:siparis_adresozet,siparis_adres=:siparis_adres,siparis_statu=:siparis_statu WHERE siparis_id=:siparis_id ";
$query=$dbh->prepare($sql);
$query->bindParam(':siparis_isim',$siparis_isim,PDO::PARAM_STR);
$query->bindParam(':siparis_tel',$siparis_tel,PDO::PARAM_STR);
$query->bindParam(':siparis_email',$siparis_email,PDO::PARAM_STR);
$query->bindParam(':siparis_il',$siparis_il,PDO::PARAM_STR);
$query->bindParam(':siparis_ilce',$siparis_ilce,PDO::PARAM_STR);
$query->bindParam(':siparis_adresozet',$siparis_adresozet,PDO::PARAM_STR);
$query->bindParam(':siparis_adres',$siparis_adres,PDO::PARAM_STR);

$query->bindParam(':siparis_statu',$siparis_statu,PDO::PARAM_STR);
$query->bindParam(':siparis_id',$siparis_id,PDO::PARAM_STR);
$query->execute();

if ($query->rowCount()>0) {
	$mesaj="Tebrikler Siparişiniz Alınmıştır";
	$mesajrenk="text-success";
	unset($_SESSION['sepet']);
}else{
	$mesaj="Eyvah Bir Hata Oluştu.Lütfen Tekrar Deneyin";
	$mesajrenk="text-danger";
}



 ?>


 <h1 class="text-center <?php echo $mesajrenk; ?> pt-5 mt-5">
 	<?php echo $mesaj; ?>
 </h1>



 <?php include('footer.php'); ?>