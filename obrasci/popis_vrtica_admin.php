<?php
$putanja = dirname($_SERVER["REQUEST_URI"],2);

require "../sesija.class.php";
require "../baza.class.php";

Sesija::kreirajSesiju();
if(!isset($_SESSION["uloga"])){
    $_SESSION["uloga"] = 4;
}

if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] > 1){
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

?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Popis vrtica admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/popis_vrtica_admin.js"></script>
</head>



<body>
    <header>
        <?php
            include "../meni.php";
        ?>
    </header>

    <div class="vrtic-container">
        <div class="vrtic-submeni">
            <a href="vrtic.php">Dodaj vrtić</a>
            <a href="popis_vrtica_admin.php">Popis vrtića</a>
            <a href="tablica_djece.php">Stanje vrtića</a>
            <a href="ocjena_vrtica.php">Ocjena vrtića</a>
        </div>
        <div class="vrtic-content"> 
            <h2>Popis vrtića</h2>
            <table name="popis_javnih_poziva_tablica" id="popis_javnih_poziva_tablica" class="prijava_djeteta_table">
                <thead>
                    <tr>
                        <th>Vrtic</th>
                        <th>Adresa vrtića</th>
                        <th>Moderator</th>
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