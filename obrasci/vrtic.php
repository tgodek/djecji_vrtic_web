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


if(isset($_POST["submit"])){
    $veza = new Baza(); 
    $veza->spojiDB();

    $ime_vrtica = $_POST["ime_vrtica"];
    $adresa_vrtica = $_POST["adresa_vrtica"];
    $moderator = $_POST["moderator"];

    $upit = "INSERT INTO `vrtic`(`ime_vrtica`, `lokacija`, `korisnik_ID`) 
    VALUES ('{$ime_vrtica}','{$adresa_vrtica}','{$moderator}')";
    $rezultat = $veza->updateDB($upit);
    $veza->zatvoriDB();
}
?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Vrtic</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/vrtic.js"></script>
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
            <h2>Dodaj novi vrtić</h2>
            <form novalidate method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-dijete">
                    <label for="ime_vrtica">Ime vrtića:</label>
                    <input type="text" id="ime_vrtica" name="ime_vrtica">
                </div>

                <div class="form-dijete">
                    <label for="adresa_vrtica">Adresa vrtića:</label>
                    <input type="text" id="adresa_vrtica" name="adresa_vrtica">
                </div>

                <div class="form-dijete">
                    <label for="moderator">Moderator:</label>
                    <select id="moderator" name="moderator" class="dropdown">
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