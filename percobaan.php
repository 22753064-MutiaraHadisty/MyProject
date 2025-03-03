<?php
echo "<h3>1. Variable</h3>";
$name = "Mutiara";
$age = 20;
echo "Nama: " . $name . "<br>";
echo "Umur: " . $age . " tahun <br>"; 

echo "<h3>2. Konstanta</h3>";
define("SITE_NAME", "Belajar PHP");
echo "Nama Situs: " . SITE_NAME . "<br>";

echo "<h3>3. Tipe Data Integer</h3>";
$integerNumber = 100;
echo "Nilai Integer: " . $integerNumber . "<br>";

echo "<h3>4. Tipe Data String</h3>";
$stringText = "Hello, Mutiara! <br>";
echo "Teks: " . $stringText . "<br>";

echo "<h3>5. Tipe Data Float</h3>";
$floatNumber = 10.5;
echo "Nilai Float: " . $floatNumber . "<br>";

echo "<h3>6. Operator Aritmatika</h3>";
$a = 10;
$b = 5;
$sum = $a + $b;
$diff = $a - $b;
$mul = $a * $b;
$div = $a / $b;
$mod = $a % $b;

echo "Nilai A: $a <br>";
echo "Nilai B: $b <br>";
echo "Penjumlahan (A + B): $sum <br>";
echo "Pengurangan (A - B): $diff <br>";
echo "Perkalian (A * B): $mul <br>";
echo "Pembagian (A / B): $div <br>";
echo "Modulus (A % B): $mod <br>";

echo "<h3>7. Operator Logika</h3>";
$x = true;
$y = false;
$andResult = $x && $y;
$orResult = $x || $y;
$notResult = !$x;

echo "AND (true && false): " . ($andResult ? 'true' : 'false') . "<br>";
echo "OR (true || false): " . ($orResult ? 'true' : 'false') . "<br>";
echo "NOT (!true): " . ($notResult ? 'true' : 'false') . "<br>";

echo "<h3>8. Struktur Logika IF</h3>";
if ($age >= 18) {
    echo "Anda sudah makan <br>";
} else {
    echo "Anda belum makan <br>";
}

echo "<h3>9. Struktur Logika SWITCH</h3>";
$day = "Senin";
switch ($day) {
    case "Senin":
        echo "Hari ini adalah Senin <br>";
        break;
    case "Selasa":
        echo "Hari ini adalah Selasa <br>";
        break;
    default:
        echo "Hari tidak dikenali <br>";
}

echo "<h3>10. Perulangan For</h3>";
for ($i = 1; $i <= 5; $i++) {
    echo "Angka: $i <br>";
}

echo "<h3>11. Perulangan Foreach</h3>";
$animals = ["Kucing", "Anjing", "Kelinci"];
foreach ($animals as $animal) {
    echo "Hewan: $animal <br>";
}

echo "<h3>12. Perulangan While</h3>";
$counter = 1;
while ($counter <= 3) {
    echo "Perulangan While ke-$counter <br>";
    $counter++;
}

echo "<h3>13. Penulisan Function</h3>";
function greet($name) {
    return "Halo, $name! <br>";
}
echo greet("Alice");

?>
