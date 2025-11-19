<?php
$jumlah_penyelesaian = 0;

echo "<h2>Penyelesaian Persamaan x + y + z = 25 (x, y, z adalah bilangan asli)</h2>";
echo "<pre>"; 

for ($x = 1; $x <= 23; $x++) {
    
 
    for ($y = 1; $y <= 23; $y++) {
        
        
        $z_hitung = 25 - $x - $y;

      
        if ($z_hitung >= 1) { 
            if ($z_hitung == floor($z_hitung)) {
                echo "x = ".$x.", y = ".$y.", z = ".$z_hitung."<br />"; 
                $jumlah_penyelesaian++; 
            }
        }
    }
}

echo "</pre>";
echo "<hr>";
echo "<h3>Jumlah Penyelesaian: ".$jumlah_penyelesaian."</h3>"; 

?>