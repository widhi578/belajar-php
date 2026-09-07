<?php

$nilai = readline("Masukkan nilai: ");

if ($nilai >= 90) {
    echo "A\n";
} 
elseif ($nilai >= 80) {
    echo "B\n";
} 
elseif ($nilai >= 70) {
    echo "C\n";
} 
else {
    echo "D\n";
}

?>