<?php

$pecahan = [100000, 50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100];

$totalbelanja = 700649;
$uang = 800000;
$kembalian = 0;
$genap = 0;
$sisa = 0;

if($uang<$totalbelanja) {

	echo "uang yang diserahkan kurang";
} else if ($uang == $totalbelanja){

	echo "uang pas";
} else {
	
	$kembalian = $uang - $totalbelanja;
	
	echo "Kembalian yang harus dibayar kasir adalah ".$kembalian;
	
	echo "dibulatkan menjadi " .round($kembalian, -2);
	
	$jumahpecahan = count($pecahan);
	
	for ($hitung = 0; $hitung < $jumahpecahan; $hitung++) {
            $genap = floor($kembalian / $pecahan[$hitung]);
            $sisa = $kembalian % $pecahan[$hitung];
            if ($genap > 0) {
					echo $genap;
     
                if ($pecahan[$hitung] > 1000) {
                    echo "lembar";
                }
                else {
                    echo "keping";
                }
                
            }
            $kembalian = $sisa;
        }
}