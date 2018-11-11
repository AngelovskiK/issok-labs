<h3>Вежба 2.1 – Работа со форми</h3>
<html>
<head>
    <title>Vezba so formi</title>
</head>
<body>
    <?php 
        if(isset($_COOKIE['ime'])) {
            echo "Hello ".$_COOKIE['ime'];
        }
    ?>
    <form method="GET" action="collect.php">
        <h3>Registracija:</h3>
        Ime: <input type="text" name="ime" /> <br />
        Prezime: <input type="text" name="prezime" /> <br />
        Email: <input type="text" name="email" /> <br />
        Masko: <input type="radio" name="pol" value="1" />
        Zensko: <input type="radio" name="pol" value="0" /> <br />
        <input type="checkbox" name="zapamti"> Zapamti <br />
        <input type="submit" name="submit" value="Vnesi" />
    </form>
</body>
</html>