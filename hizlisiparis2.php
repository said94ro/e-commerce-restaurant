
<?php include('header.php'); ?>

<?php include('topbar.php'); ?>

<?php include('menu.php'); ?>

<?php 

$yemek_id=$_POST['yemek_id'];
$yemek_isim=$_POST['yemek_isim'];
$yemek_resim=$_POST['yemek_resim'];
$yemek_kategori=$_POST['yemek_kategori'];
$yemek_fiyat=$_POST['yemek_fiyat'];
$yemek_indirimlifiyat=$_POST['yemek_indirimlifiyat'];
$siparis_isim=$_POST['siparis_isim'];
$siparis_tel=$_POST['siparis_tel'];
$siparis_adres=$_POST['siparis_adres'];
$siparis_adet=$_POST['siparis_adet'];
if ($yemek_indirimlifiyat>0) {
	$satisfiyat=$yemek_indirimlifiyat;
}else{
	$satisfiyat=$yemek_fiyat;
}
$siparis_toplam=$siparis_adet*$satisfiyat;
$siparisler="$yemek_isim $siparis_adet";
$siparis_tipi="Hızlı Sipariş";
$siparis_statu="0";# 0 tamamlanmayan 1 tamamlanan 2 iade 3 teslim edildi 4 teslim edilemedi.

if (isset($_POST['siparis_ver'])) {
	$sql="INSERT INTO siparisler (siparis_isim,siparis_telefon,siparis_miktar,siparis_siparisler,siparis_tipi,siparis_statu,siparis_adres) VALUES (:siparis_isim,:siparis_telefon,:siparis_miktar,:siparis_siparisler,:siparis_tipi,:siparis_statu,:siparis_adres)";
	$query=$dbh->prepare($sql);
	$query->bindParam(':siparis_isim',$siparis_isim,PDO::PARAM_STR);
	$query->bindParam(':siparis_telefon',$siparis_tel,PDO::PARAM_STR);
	$query->bindParam(':siparis_miktar',$siparis_toplam,PDO::PARAM_STR);
	$query->bindParam(':siparis_siparisler',$siparisler,PDO::PARAM_STR);
	$query->bindParam(':siparis_tipi',$siparis_tipi,PDO::PARAM_STR);
	$query->bindParam(':siparis_statu',$siparis_statu,PDO::PARAM_STR);
	$query->bindParam(':siparis_adres',$siparis_adres,PDO::PARAM_STR);

	$query->execute();



}



 ?>


 <div class="container">
 	<div class="row">
 		<div class="col-md-6 bg-light mx-auto p-3">
 			<form action="hizlisparis2.php" method="POST">
 			<div class="card mb-3" >
			  <div class="row g-0">
			    <div class="col-md-4">
			      <img src="img/urunler/<?php echo $yemek_resim; ?>" class="img-fluid rounded-start" alt="...">
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title"><?php echo $yemek_isim; ?></h5>
			        <p class="card-text text-dark ">
			        	<small>Küçükyalı Mahallesi Hastane Caddei 15/A Maltepe/İstanbul</small>
			        </p>
			        <p>
			        	
			        </p>
			        <p class="card-text">
			        	<h4><?php echo $siparis_toplam ?>₺</h4>
			        	<span><?php echo $siparis_adet . ' adet ' . $yemek_isim ?></span>
			    
			        </p>
			        <p class="card-text"><small class="text-muted">

			        <span><?php echo $yemek_kategori; ?></span>><span><?php echo $yemek_isim; ?></span>


			    	</small></p>
			      </div>
			    </div>
			  </div>
			</div>

			<div>
				<h4 class="text-dark text-center py-4">Sipariş Bilgileri</h3>

				
				<p>Sipariş İsim:<?php echo $siparis_isim; ?></p>
				<p>Adres:<?php echo $siparis_adres; ?></p>
				
				
				
				
				



			</div>

				

	

			</form>
			<div>
				
				

				<a style="float:right;" class="btn btn-success" href="https://wa.me/905054407855?text=<?php echo $siparis_adet.' adet '.$yemek_isim.' istiyorum adres '.$siparis_adres.' ücret '.$siparis_toplam ?>">Whatsapp ile Siparişi Tamamla</a>


				




				




			</div>
 		</div>
 	</div>
 </div>















<?php include('footer.php'); ?>