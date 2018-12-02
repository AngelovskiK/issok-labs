<?php 

$prva = fopen("prva.txt", "r") or die("Unable to open file prva!");
$rez = fopen("rezultat.txt", "w") or die("Unable to open file rezultat!");
$vtora = fopen("vtora.txt", "r") or die("Unable to open file vtora!");

$prvaText = fread($prva,filesize("prva.txt"));
$vtoraText = fread($vtora,filesize("vtora.txt"));

fwrite($rez, $prvaText);
fclose($prva);

$prva = fopen("prva.txt", "w") or die("Unable to open file prva!");

fwrite($prva, str_replace("-", " ", $prvaText));
fwrite($rez, $vtoraText);

fclose($prva);
fclose($rez);
fclose($vtora);