<?php
$putanja = dirname($_SERVER["REQUEST_URI"],2);

require "../sesija.class.php";
require "../baza.class.php";

Sesija::kreirajSesiju();
if(!isset($_SESSION["uloga"])){
    $_SESSION["uloga"] = 4;
}

if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] != 2){
    header("Location:../prijava.php");
}

if(isset($_COOKIE["id"]) || !isset($_COOKIE["id"])){
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

if(!empty($_POST['odobri_zahtjev'])){
    $javni_poziv = $_POST['javni_poziv'];
    $veza = new Baza();
    $veza->spojiDB();

    $upit_prijava = "update prijava SET status_prijave = 'odobren' WHERE javni_poziv_ID = '{$javni_poziv}';";
    $rezultat = $veza->updateDB($upit_prijava);

    $veza->zatvoriDB();
}

?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Skupine</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/popis_prijava_moderator.js"></script>
</head>



<body>
    <header>
        <?php
            include "../meni.php";
        ?>
    </header>

    <div class="vrtic-container">
        <div class="vrtic-content"> 
            <h2>Popis prijava</h2>
            <table name="popis_javnih_poziva_tablica" id="popis_javnih_poziva_tablica" class="prijava_djeteta_table">
                <thead>
                    <tr>
                        <th>Rok prijave</th>
                        <th>Datum prijave</th>
                        <th>Status prijave</th>
                        <th>Ime korisnika</th>
                    </tr>
                </thead>

                <tbody>
                    
                </tbody>
            </table>
           
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