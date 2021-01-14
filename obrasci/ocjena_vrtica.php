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

    $vrtic = $_POST["vrtic"];
    $mjesec = $_POST["mjesec"];
    $godina = $_POST["godina"];
    $ocjena = $_POST["ocjena"];

    $upit = "INSERT INTO `ocjena_vrtica` (`mjesec`, `godina`, `ocjena`, `vrtic_ID`, `korisnik_ID`) 
    VALUES ('{$mjesec}', '{$godina}', '{$ocjena}', '{$vrtic}' ,'{$id}');";
    
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
    <script type="text/javascript" src="../javascript/ocjena_vrtica.js"></script>
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
            <h2>Ocjeni vrtić</h2>
            <form novalidate method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-dijete">
                    <label for="vrtic">Vrtić:</label>
                    <select id="vrtic" name="vrtic" class="dropdown">
                    </select>
                </div>

                <div class="form-dijete">
                    <label for="mjesec">Mjesec:</label>
                    <select id="mjesec" name="mjesec" class="dropdown">
                        <option value="<?php echo date("m"); ?>"><?php echo date("m"); ?></option>
                    </select>
                </div>

                <div class="form-dijete">
                    <label for="godina">Godina:</label>
                    <select id="godina" name="godina" class="dropdown">
                        <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                    </select>
                </div>

                <div class="form-dijete">
                    <label for="ocjena">Ocjena:</label>
                    <input type="number" name="ocjena" id="ocjena" min="1" max="10">
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