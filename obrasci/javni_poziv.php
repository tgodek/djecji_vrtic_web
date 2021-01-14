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

if(isset($_COOKIE["id"])){
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

    $broj_mjesta = $_POST["broj_mjesta"];
    $razdoblje_pocetak = $_POST["razdoblje_pocetak"];
    $razdoblje_kraj = $_POST["razdoblje_kraj"];
    $vrtic = $_POST["svoj_vrtic"];

    $upit = "INSERT INTO `javni_poziv` (`broj_mjesta`, `datum_vrijeme_pocetak`, `datum_vrijeme_kraj`, `vrtic_ID`, `korisnik_ID`) 
    VALUES ('{$broj_mjesta}', '{$razdoblje_pocetak}', '{$razdoblje_kraj}', '{$vrtic}' ,'{$id}');";
    
    $rezultat = $veza->updateDB($upit);
    $veza->zatvoriDB();
}
?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Javni poziv</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/javni_poziv.js"></script>
</head>



<body>
    <header>
        <?php
            include "../meni.php";
        ?>
    </header>

    <div class="vrtic-container">
        <div class="vrtic-submeni">
            <a href="skupine.php">Dodaj Skupinu</a>
            <a href="javni_poziv.php">Dodaj javni poziv</a>
            <a href="popis_skupina.php">Popis skupina</a>
            <a href="popis_javnih_poziva.php">Popis javnih poziva</a>
        </div>
        <div class="vrtic-content"> 
            <h2>Dodaj novi javni poziv</h2>
            <form novalidate method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-dijete">
                    <label for="broj_mjesta">Broj mjesta:</label>
                    <input type="number" id="broj_mjesta" name="broj_mjesta">
                </div>

                <div class="form-dijete">
                    <label for="razdoblje_pocetak">Početak prijave:</label>
                    <input type="datetime-local" id="razdoblje_pocetak" name="razdoblje_pocetak">
                </div>

                <div class="form-dijete">
                    <label for="razdoblje_kraj">Kraj prijave:</label>
                    <input type="datetime-local" id="razdoblje_kraj" name="razdoblje_kraj">
                </div>

                <div class="form-dijete">
                    <label for="razdoblje_kraj">Vrtic:</label>
                    <select id="svoj_vrtic" name="svoj_vrtic" class="dropdown">
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