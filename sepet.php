<?php include('header.php'); ?>

<?php include('topbar.php'); ?>

<?php include('menu.php'); ?>

<?php 
if (isset($_POST['sepete_ekle'])) {
	

$yemek_id=$_POST['yemek_id'];
$yemek_adet=$_POST['yemek_adet'];
if ($_POST['yemek_indirimlifiyat']>0) {
	$yemek_fiyat=$_POST['yemek_indirimlifiyat'];
}else{
	$yemek_fiyat=$_POST['yemek_fiyat'];

}


$yemek_isim=$_POST['yemek_isim'];
$yemek_sepet=$yemek_id."-".$yemek_adet."-".$yemek_fiyat."-".$yemek_isim;
if (isset($_SESSION['sepet'])) {
	$sepet_liste=$_SESSION['sepet'];
	array_push($sepet_liste,$yemek_sepet);
	$_SESSION['sepet']=$sepet_liste;
}else{
	$sepet_liste=[];
	array_push($sepet_liste,$yemek_sepet);
	$_SESSION['sepet']=$sepet_liste;

}


}else{
	$sepet_liste=$_SESSION['sepet'];
}



 ?>


<div class="container pt-5">
	<div class="row">
		<div class="col-md-8">
			<table class="table ">
  <thead>
    <tr class="table-danger">
      <th scope="col"></th>
      <th scope="col">Sepetteki Ürünler</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  	<tr class="table-light">
      <th scope="row">Ürün İsmi</th>
      <th>Adet</th>
      <th>Adet/Fiyat</th>
      <th>Toplam Fiyat</th>
    </tr>
    <?php $geneltoplam=0; ?>
    <?php $siparis_urunler=[]; ?>
  	<?php foreach($sepet_liste as $sepet_urun): ?>
  	<?php $s_urun=explode("-",$sepet_urun); ?>
  	<?php 
  	$u_fiyat=$s_urun[2];
  	$u_adet=$s_urun[1];
  	$u_toplam=$u_adet*$u_fiyat;

  	 ?>
    <tr>
      <th scope="row"><?php echo $s_urun[3]; ?></th>
      <td><?php echo $s_urun[1]; ?></td>
      <td><?php echo $s_urun[2]; ?> ₺</td>
      <td><?php echo $u_toplam;  ?> ₺</td>
      <?php $siparis_urun="$s_urun[3] $s_urun[1] $s_urun[2]"; 
      array_push($siparis_urunler,$siparis_urun);
      ?>
    </tr>
    <?php $geneltoplam=$u_toplam+$geneltoplam; ?>
	<?php endforeach; ?>
		<?php $siparis_urunler=implode("-", $siparis_urunler); ?>
    
  </tbody>
</table>
		</div>
		<div class="col-md-4">
			<div class="card bg-secondary">
			  
			  <ul class="list-group list-group-flush">
			    <li class="list-group-item"><h5>Sipariş Özeti</h5></li>
			    <li class="list-group-item">Ürün Toplam: <?php echo $geneltoplam; ?> ₺<span></span></li>
			    <li class="list-group-item">Hizmet Bedeli: 7₺</li>
			  </ul>
			  
			</div>
			<form class="mt-3" action="odeme.php" method="POST"><br>
					<input type="radio" name="siparis_tip" value="kapida"> Kapıda Ödeme <br>
					<input type="radio" name="siparis_tip" value="kredikarti"> Kredi Kartı<br><br>
					<input type="hidden" name="siparis_urunler" value="<?php echo $siparis_urunler;  ?>">
					<input type="hidden" name="siparis_toplam" value="<?php echo $geneltoplam; ?>">
			  	<input type="submit" name="odeme_sayfasi" value="Ödeme Yap" class="btn btn-success" style="width:100%" >
			  </form>
		</div>
	</div>
</div>













<?php include('footer.php'); ?>