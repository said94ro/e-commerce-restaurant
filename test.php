<?php 

include('testfonksiyon.php');

$liste=[13,45,33,22,11,44,33];


foreach ($liste as $l) {
	$fiyat=dolarkdv($l);
	echo $fiyat;
	echo "<br>";
}

 ?>


