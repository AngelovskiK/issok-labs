<?php
    echo "<h3>Вежба	2.1 –	Конкатенација	на	стринг</h3>";
    $ime = "Kristijan";
    $prezime = "Angelovski";
    echo $ime." ".$prezime."<br/>";

    echo "<h3>Вежба	2.2 – Функции</h3>";
    echo strtoupper("strtoupper gi zgolemuva site bukvi vo golemi")."<br/>";
    echo strtolower("strtolower gi namaluva site BUKVI vo MALI")."<br/>";
    echo ucfirst("ucfirst ja zgolemuva prvata bukva na sekoja recenica. Primer.")."<br/>";
    echo ucwords("ucwords ja zgolemuva prvata bukva na sekoj zbor")."<br/>";
    
    echo "<h3>Вежба	2.3 – Поле	->	Стринг</h3>";
    $arr = array("programski", "praktikum", "laboratoriski", "vezbi");
    echo implode(" ", $arr)."<br/>";
?>