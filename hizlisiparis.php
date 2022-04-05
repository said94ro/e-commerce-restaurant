
<?php include('header.php'); ?>

<?php include('topbar.php'); ?>

<?php include('menu.php'); ?>

<?php 

if (isset($_GET['yemek'])) {
	

$yemek_id=$_GET['yemek'];


$sql="SELECT * FROM yemek WHERE yemek_id=:yemek_id";
$query=$dbh->prepare($sql);
$query->bindParam(':yemek_id',$yemek_id,PDO::PARAM_STR);
$query->execute();
$yemekler=$query->fetch(PDO::FETCH_OBJ);

}




 ?>


 <div class="container">
 	<div class="row">
 		<div class="col-md-6 bg-light mx-auto p-3">
 			<form action="hizlisiparis2.php" method="POST">
 			<div class="card mb-3" >
			  <div class="row g-0">
			    <div class="col-md-4">
			      <img src="img/urunler/<?php echo $yemekler->yemek_resim; ?>" class="img-fluid rounded-start" alt="...">
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title"><?php echo $yemekler->yemek_isim; ?></h5>
			        <p class="card-text text-dark ">
			        	<small>Küçükyalı Mahallesi Hastane Caddei 15/A Maltepe/İstanbul</small>
			        </p>
			        <p>
			        	<div class="input-group mb-3 py-3">
			  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-default">ADET</span>
			  <input type="number" value="1
			  " name="siparis_adet" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
			</div>
			        </p>
			        <p class="card-text">
			        	<h5 > 
			    <?php if($yemekler->yemek_indirimlifiyat>0){ ?>
			    	<span style="float:right;">
			    	<span class="text-secondary"><del><?php echo $yemekler->yemek_fiyat; ?>₺<del></span>
			    	<span class="text-danger"><big><b><?php echo $yemekler->yemek_indirimlifiyat; ?>₺</b></big></span>
			    	</span>
			    <?php }else{ ?>

					<span style="float:right;">
			    	<span class="text-danger">
			    		<big><strong><?php echo $yemekler->yemek_fiyat; ?>₺</strong></big>

			    	</span>
			    	
			    	</span>

			    <?php } ?>

			    </h4>
			        </p>
			        <p class="card-text"><small class="text-muted">

			        <span><?php echo $yemekler->yemek_kategori; ?></span>><span><?php echo $yemekler->yemek_isim; ?></span>


			    	</small></p>
			      </div>
			    </div>
			  </div>
			</div>

			<div>
				<h4 class="text-dark text-center py-4">Sipariş Bilgileri</h3>

				<div class="row mb-3">
					<div class="col-md-6">
						<input type="text" name="siparis_isim" class="form-control" placeholder="İsim Soyisim" >
					</div>
					<div class="col-md-6">
						<input type="tel" name="siparis_tel" class="form-control" placeholder="Telefon numarası">
						<input type="hidden" name="yemek_id" value="<?php echo $yemekler->yemek_id ?>">
						<input type="hidden" name="yemek_isim" value="<?php echo $yemekler->yemek_isim ?>">
						<input type="hidden" name="yemek_resim" value="<?php echo $yemekler->yemek_resim ?>">
						<input type="hidden" name="yemek_fiyat" value="<?php echo $yemekler->yemek_fiyat ?>">
						<input type="hidden" name="yemek_kategori" value="<?php echo $yemekler->yemek_kategori ?>">
						<input type="hidden" name="yemek_indirimlifiyat" value="<?php echo $yemekler->yemek_indirimlifiyat ?>">
					</div>
				</div>
				
				<textarea class="form-control" rows="4" name="siparis_adres" placeholder="Adres"></textarea>
				<br>
				<br>
				<input type="submit" name="siparis_ver" value="Siparişi Oluştur" class="btn btn-success" style="float:right;">
				<a href="index.php" class="btn btn-outline-secondary" style="float:right;color:#ccc;border:1px solid #ccc;margin-right:10px;width:130px;">İptal</a>
				



			</div>

				

	

			</form>
			<div>
				
				<?php if (isset($_GET['siparis_ver'])) {

					$siparis_isim=$_GET['siparis_isim'];
					$siparis_tel=$_GET['siparis_tel'];
					$siparis_adres=$_GET['siparis_adres'];
					$siparis_adet=$_GET['siparis_adet'];

					$toplamfiyat=$siparis_adet*$_SESSION['yemek_indirimlifiyat'];



					
				?>

				<h5>Toplam Fiyat:<span class="text-danger"><?php echo $toplamfiyat; ?>₺</span></h5>
				<span class="text-secondary">
					<small>
						<?php echo $siparis_adet +"adet"+$_SESSION['yemek_isim'] ; ?>
					</small>
				</span>





				<?}?>




			</div>
 		</div>
 	</div>
 </div>















<?php include('footer.php'); ?>