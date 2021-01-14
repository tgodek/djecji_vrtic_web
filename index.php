<?php
    $putanja = dirname($_SERVER["REQUEST_URI"]);
    require "sesija.class.php";
    
    Sesija::kreirajSesiju();
    if(!isset($_SESSION["uloga"])){
        $_SESSION["uloga"] = 4;
    }

?>
<!DOCTYPE html>

<html lang="hr">
    <head>
        <title>Pocetna</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="TG">
        <meta name="keywords" content="vrtic, WebDiP, projekt">
        <meta name="description" content="Pocetna stranica">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="css/tgodek.css" rel="stylesheet" type="text/css" />
        <link href="css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <header>
            <?php
                include "meni.php";
            ?>
        </header>

        <section class="prva-sekcija">
            <div class="glavni-container">
                <img src="multimedija/naslovna.png" alt="">
            </div>
        </section>

        <footer>
            <p class="foter-p">KIDLER &copy; 2020 Website by</p>
            <address>
                <a href="mailto:tgodek@foi.hr">Tomislav Godek</a><br>
            </address>
        </footer>
    </body>
</html>