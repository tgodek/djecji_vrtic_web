<?php
$putanja = dirname($_SERVER["REQUEST_URI"],2);

require "../sesija.class.php";
require "../baza.class.php";

Sesija::kreirajSesiju();
if(!isset($_SESSION["uloga"])){
    $_SESSION["uloga"] = 4;
}

if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] != 3){
    header("Location:../prijava.php");
}

if(!isset($_COOKIE["id"])){
    $veza = new Baza(); 
    $veza->spojiDB();
    $ime = $_SESSION["korisnik"];
    $upit_korisnik = "select korisnik_ID from korisnik where kor_ime='{$ime}';";
    $rezultat = $veza->selectDB($upit_korisnik);
    while($row = mysqli_fetch_array($rezultat)){
        $id = $row["korisnik_ID"]; 
    };
    $veza->zatvoriDB();
    setcookie("id", $id);
}

if(isset($_GET["submit_zahtjev"])){
    $javni_poziv_id = $_GET["javni_poziv"];
    $vrtic_ID = $_GET["vrtic_ID_value"];
    setcookie("vrtic", $vrtic_ID);
    setcookie("javni_poziv", $javni_poziv_id);
}



?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Prijava djeteta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/prijava_cekanje.js"></script>
</head>



<body>
    <header>
        <?php
            include "../meni.php";
        ?>
    </header>

    <div class="vrtic-container">
        <div class="vrtic-content"> 
            <h2>odaberi skupinu</h2>
            <form novalidate method="post" action="popis_prijava.php">
                <div class="form-dijete">
                    <label for="vrtic">Skupina odabranog vrtića:</label>
                    <select id="skupine" name="skupine" class="dropdown">
                    </select>
                </div>

                <div class="form-dijete">
                    <input type="submit" name="submit" id="submit" value="Dodaj" class="plava-tipka">
                </div>
            </form> 
        </div>
    </div>

    <footer>
        <p class="foter-p">KIDLER &copy; 2020 Website by</p>
        <address>
            <a href="mailto:tgodek@foi.hr">Tomislav Godek</a><br>
        </address>
    </footer> 

</body>

</html>