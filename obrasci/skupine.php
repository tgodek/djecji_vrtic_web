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


if(isset($_POST["submit"])){
    $veza = new Baza(); 
    $veza->spojiDB();

    $naziv_skupine = $_POST["naziv_skupine"];
    $mj_naplata = $_POST["mj_naplata"];
    $vrtic = $_POST["svoj_vrtic"];

    $upit = "INSERT INTO `skupina` (`naziv_skupine`, `mj_naplata`, `korisnik_ID`, `vrtic_ID`) VALUES ('{$naziv_skupine}', '{$mj_naplata}', '{$id}', '{$vrtic}');";
    
    $rezultat = $veza->updateDB($upit);
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
            <h2>Dodaj novu skupinu</h2>
            <form novalidate method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-dijete">
                    <label for="naziv_skupine">Ime skupine:</label>
                    <input type="text" id="naziv_skupine" name="naziv_skupine">
                </div>

                <div class="form-dijete">
                    <label for="mj_naplata">Mjesečna naplata:</label>
                    <input type="text" id="mj_naplata" name="mj_naplata">
                </div>

                <div class="form-dijete">
                    <label for="vrtic">Vrtić:</label>
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