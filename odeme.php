

<?php include('header.php'); ?>

<?php include('topbar.php'); ?>

<?php include('menu.php'); ?>


<?php 

$siparis_tip=$_POST['siparis_tip'];
$siparis_urunler=$_POST['siparis_urunler'];
$siparis_toplam=$_POST['siparis_toplam'];

$sql="INSERT INTO sepetsiparis (siparis_tip,siparis_urunler,siparis_toplam) VALUES (:siparis_tip,:siparis_urunler,:siparis_toplam)";
$query=$dbh->prepare($sql);
$query->bindParam(':siparis_tip',$siparis_tip,PDO::PARAM_STR);
$query->bindParam(':siparis_urunler',$siparis_urunler,PDO::PARAM_STR);
$query->bindParam(':siparis_toplam',$siparis_toplam,PDO::PARAM_STR);
$query->execute();
$son=$dbh->lastInsertId();




?>
<form action="odemekontrol.php" method="POST">
	<h2 class="text-center text-dark py-4">Ödeme Bilgileri</h2>
	<div class="container">
		<div class="row bg-light py-3">

			<div class="col-md-8">
				<div class="row"> 

			<div class="col-md-4 py-2">
				<input type="text" name="siparis_isim" class="form-control" placeholder="İsim Soyisim">
				<input type="hidden" name="siparis_id" value="<?php echo $son ?>">
			</div>

			<div class="col-md-4 py-2">
				<input type="tel" name="siparis_tel" class="form-control" placeholder="Telefon">
			</div>

			<div class="col-md-4 py-2">
				<input type="email" name="siparis_email" class="form-control" placeholder="Email">
			</div>

			<div class="col-md-4 py-2">
				<select class="form-control" name="siparis_sehir">
					<option>Şehir Seçiniz</option>
					<option value="İstanbul">İstanbul</option>
					<option value="Ankara">Ankara</option>
					<option value="Urfa">Urfa</option>
				</select>
			</div>

			<div class="col-md-4 py-2">
				<input type="text" name="siparis_ilce" placeholder="İlçe" class="form-control py-2">
			</div>

			<div class="col-md-4 py-2">
				<input type="text" name="siparis_adresozet" placeholder="Adres Özeti" class="form-control py-2">
			</div>

			<div class="col-md-12 py-2">
				<textarea name="siparis_adres" class="form-control" placeholder="Adres" rows="3"></textarea>
			</div>

			<input type="hidden" name="siparis_tip" value="<?php echo $siparis_tip; ?>">
		
		</div>
		</div>

		<div class="col-md-4">
			<div class="row">
				
			
			
				<?php if($siparis_tip=="kredikarti"){ ?>

					
					
					<div class="col-md-12 mx-auto bg-white p-3 pb-5" style="border:1px solid dimgrey;border-radius:9px;">
						<h3 class="text-dark text-center p-3 ">Kredi Kartı Bilgileri</h3>
						<div><input type="text" name="kredikarti_isim" class="form-control my-2" placeholder="Kredi Kartı İsim"><br></div>
						<div><input type="text" name="kredikarti_numara" class="form-control my-2" placeholder="Kredi Kartı No"><br></div>
						<div class="row">
							<div class="col-md-4"><input type="text" name="kredikarti_sonkullanma_ay" class="form-control my-2" placeholder="Ay" >
							</div>

							<div class="col-md-4">
							<input type="text" name="kredikarti_sonkullanma_yil" class="form-control my-2" placeholder="YIL" >
							</div>

							<div class="col-md-4">
						<input type="password" name="kredikarti_cvv" class="form-control my-2" placeholder="CVV" >
						</div>
						<div class="mt-3">
					<input type="submit" name="siparis_tamamla" value="Siparişi Tamamla" class="btn btn-success" style="width:100%">
					</div>
							
						</div>

					</div>
					<br>
					<br>
					


				<?php } ?>
			
			<div class="col-md-12 mt-2" style="float:right;">
				<?php  if($siparis_tip=="kapida"){ ?>

<input type="submit" name="siparis_tamamla" value="Siparişi Tamamla" class="btn btn-success" style="width:100%">
				<?php } ?>
				
			</div>
			
			

			</div>
		</div>


		</div>
	</div>
</form>












<?php include('footer.php'); ?>