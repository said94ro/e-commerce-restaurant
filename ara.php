
<?php include('header.php'); ?>

<?php include('topbar.php'); ?>

<?php include('menu.php'); ?>





<?php 

$kelime=$_GET['ara'];


$sql="SELECT * FROM yemek WHERE CONCAT(yemek_isim,'',yemek_kategori) LIKE :yemek_isim";

$query=$dbh->prepare($sql);
$query->bindValue(':yemek_isim','%'.$kelime.'%');
$query->execute();
$yemekler=$query->fetchall(PDO::FETCH_OBJ);

 ?>


<div class="container">
	<div class="row mt-5">
		<div class="col-12 bg-dark text-light text-center pt-2"><h2>Arama Sonuçları</h2></div>

		<div class="col-12 mt-4">
			<form class="d-flex" action="" method="GET">
	        <input class="form-control me-2" name="ara" type="search" placeholder="Ürün , Kategori veya Restoran Ara" aria-label="Search">
	        <button class="btn btn-outline-dark" type="submit">ARA</button>
	      </form>
		</div>
	</div>
	<div class="row pt-3">

		<?php if($query->rowCount()>0){ ?>


			<?php foreach($yemekler as $yemek): ?>
		
		<!--Ürün Başlangıç-->
		<div class="col-md-3 col-6 p-2">
			<form action="sepet.php" method="POST">
			<div class="card">

			  <img src="img/urunler/<?php echo $yemek->yemek_resim; ?>" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h4 class="card-title"><?php echo $yemek->yemek_isim; ?> 
			    <?php if($yemek->yemek_indirimlifiyat>0){ ?>
			    	<span style="float:right;">
			    	<span class="text-secondary"><del><?php echo $yemek->yemek_fiyat; ?>₺<del></span>
			    	<span class="text-danger"><big><b><?php echo $yemek->yemek_indirimlifiyat; ?>₺</b></big></span>
			    	</span>
			    <?php }else{ ?>

					<span style="float:right;">
			    	<span class="text-danger">
			    		<big><strong><?php echo $yemek->yemek_fiyat; ?>₺</strong></big>

			    	</span>
			    	
			    	</span>

			    <?php } ?>

			    </h4>
			  
			  <div class="input-group mb-3 py-3">
			  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-default">ADET</span>
			  <input type="number" value="1" name="yemek_adet" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
			  <input type="hidden" name="yemek_id" value="<?php echo $yemek->yemek_id; ?>">
			  <input type="hidden" name="yemek_fiyat" value="<?php echo $yemek->yemek_fiyat; ?>">
			  <input type="hidden" name="yemek_indirimlifiyat" value="<?php echo $yemek->yemek_indirimlifiyat; ?>">
			  <input type="hidden" name="yemek_isim" value="<?php echo $yemek->yemek_isim; ?>">
			</div>
			    
			    <div class="row">
			    	<div class="col-3">
			    		
			    		<input type="submit" name="sepete_ekle" class="btn btn-danger text-center" style="width:100%" value="+">
			    	</div>
			    	<div class="col-9">
			    		<a href="hizlisiparis.php?yemek=<?php echo $yemek->yemek_id; ?>" class="btn btn-success" style="width:100%">Hızlı Sipariş</a>
			    	</div>
			    	
			    </div>


			  </div>
			</div>
			</form>
		</div>

		<!-- Ürün Bitiş -->

			<?php endforeach; ?>


		<?php } ?> 


		

		
	</div>
</div>







<?php include('footer.php'); ?>