<?php
    echo "<h3>Вежба 1.1 – Дефинирање на полиња</h3>";
    $numericArray = array(2, 5, 6, 10, 41, 24, 32, 9, 16, 19);
    $associativeArray = array("Kristijan"=>"Kristijan", "Angelovski"=>"Angelovski", "Skopje"=>"Skopje");
    echo "<h3>Вежба 1.2 – Изминување на полиња</h3>";
    foreach($numericArray as $curr) {
        echo $curr." ";
    }
    echo "<h3>Вежба	1.3 – Изминување	на	полиња и	додавање	во	ново	поле</h3>";
    $largerThan20 = array();
    foreach($numericArray as $no) {
        if($no > 20) 
            array_push($largerThan20, $no);
    }
    echo "Pogolemi od dvaeset: ".implode(",", $largerThan20);
    echo "<h3>Вежба	1.4 – Најголем и најмал елемент</h3>";
    $string = "PHP is a widely-used general-purpose scripting language that is specially suited for Web development";
    $longestWord;
    $longestWordLength = 0;
    foreach(explode(" ", $string) as $word) {
        $length = strlen($word);
        if($length > $longestWordLength) {
            $longestWordLength = $length;
            $longestWord = $word;
        }
    }

    echo "The largest word in \"PHP is a widely-used general-purpose scripting language that is specially suited for Web development\" is: ".$longestWord;
?>