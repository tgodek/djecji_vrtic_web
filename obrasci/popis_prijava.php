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

if(!isset($_COOKIE["id"]) || isset($_COOKIE["id"])){
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

if(isset($_POST["submit"])){
    $skupina = $_POST["skupine"];
    $id = $_COOKIE["id"];
    $poziv = $_COOKIE["javni_poziv"];
    $vrijeme_prijave = date("Y/m/d h:i:s");

    $veza = new Baza(); 
    $veza->spojiDB();

    $upit = "INSERT INTO `prijava` (`datum_prijave`, `javni_poziv_ID`, `skupina_ID`, `korisnik_ID`) VALUES ('{$vrijeme_prijave}', '{$poziv}', '{$skupina}', '{$id}');";
    $rezultat = $veza->updateDB($upit);

    $veza->zatvoriDB();
}

if(isset($_POST["izbrisi_prijavu"])){
    $prijava_id = $_POST["prijava_ID"];

    $veza = new Baza(); 
    $veza->spojiDB();

    $upit = "DELETE FROM prijava WHERE prijava_ID = '{$prijava_id}';";
    $rezultat = $veza->updateDB($upit);

    $veza->zatvoriDB();

    

}

?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Popis prijava</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/popis_prijava.js"></script>
</head>



<body>
    <header>
        <?php
            include "../meni.php";
        ?>
    </header>

    <div class="vrtic-container">
        <div class="vrtic-content tablica"> 
            <h2>Popis vaših prijava</h2>
            <table name="popis_javnih_poziva_tablica" id="popis_javnih_poziva_tablica" class="prijava_djeteta_table">
                <thead>
                    <tr>
                        <th>Datum prijave</th>
                        <th>Status prijave</th>
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