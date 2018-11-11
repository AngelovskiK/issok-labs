<?php
    session_start();
    echo "<h2>Primeni podatoci:</h2>";
    $ime; $prezime; $email; $pol;
    if( isset($_GET['ime'])) {
        $ime = trim(htmlspecialchars($_GET['ime']));
        if($ime != "") {
            echo "<div>Ime: ${ime}</div>";
            if( isset($_GET['zapamti'])) {
                setcookie("ime", $ime, time() + 2*60*60);
            }
        }
    }
    if( isset($_GET['prezime'])) {
        $prezime = trim(htmlspecialchars($_GET['prezime']));
        if($prezime != "") {
            echo "<div>Prezime: ${prezime}</div>";
            if( isset($_GET['zapamti'])) {
                setcookie("prezime", $prezime, time() + 2*60*60);
            }
        }
    }
    if( isset($_GET['email'])) {
        $email = trim(htmlspecialchars($_GET['email']));
        if($email != "") {
            echo "<div>Email: ${ime}</div>";
            if( isset($_GET['zapamti'])) {
                setcookie("email", $email, time() + 2*60*60);
            }
        }
    }
    if( isset($_GET['pol'])) {
        $pol = htmlspecialchars($_GET['pol']);
        if($pol == 0 || $pol == 1) {
            $pol = $pol == 1 ? "Masko" : "Zhensko";
            echo "<div>Pol: ${pol}</div>";
            if( isset($_GET['zapamti'])) {
                setcookie("pol", $pol, time() + 2*60*60);
            }
        }
    }
    if( isset($_GET['zapamti'])) {
        if(isset($_COOKIE["sessionID"]) && $_COOKIE["time"] - time() < 3600) {
            echo "<h2>Hello ${ime}, you are still logged in!!!!</h2>";
        }
        setcookie("time", time(), time() + 2*60*60);
        setcookie("sessionID", session_id());
    }
?>