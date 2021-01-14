<?php
$putanja = dirname($_SERVER["REQUEST_URI"],2);
require "../sesija.class.php";

Sesija::kreirajSesiju();
    if(!isset($_SESSION["uloga"])){
        $_SESSION["uloga"] = 4;
    }

if(isset($_POST["submit_galerija"])){
    $vrtic_ID = $_POST["vrtic_ID_galerija"];
    setcookie("vrtic_galerija", $vrtic_ID);
}

?>


<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Galerija</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/galerija.js"></script>
</head>


<body>
    <header>
        <?php
            include "../meni.php";
        ?>
    </header>
    <div class="vrtic-container">
        <div class="vrtic-content"> 
            <h2>Galerija</h2>
            <table name="popis_javnih_poziva_tablica" id="popis_javnih_poziva_tablica" class="prijava_djeteta_table">
                <thead>
                    <tr>
                        <th>OIB</th>
                        <th>Ime djeteta</th>
                        <th>Prezime djeteta</th>
                        <th>Godine</th>
                        <th>Spol</th>
                        <th>Slika</th>
                    </tr>
                </thead>

                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>