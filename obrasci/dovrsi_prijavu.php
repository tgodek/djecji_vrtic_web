<?php
$putanja = dirname($_SERVER["REQUEST_URI"],2);
$direktorij = dirname(getcwd());

require "../sesija.class.php";
require "../baza.class.php";

Sesija::kreirajSesiju();
if(!isset($_SESSION["uloga"])){
    $_SESSION["uloga"] = 4;
}

if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] != 3){
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


if(isset($_POST["dovrsi_prijavu"])){
    $prijava_ID = $_POST["prijava_ID"];
    $skupina_ID = $_POST["skupina_ID"];
    setcookie("prijava_ID", $prijava_ID);
    setcookie("skupina_ID", $skupina_ID);
}

$target_dir = "{$direktorij}/galerija/";

if(isset($_POST["submit"])){

    $ime_dat = rand(1000,10000)."_".$_FILES["slika"]["name"];
    $temp = $_FILES["slika"]["tmp_name"];
    move_uploaded_file($temp, $target_dir.'/'.$ime_dat);
    
    $oib = $_POST["oib"];
    $ime_djeteta = $_POST["ime_djeteta"];
    $prezime_djeteta = $_POST["prezime_djeteta"];
    $godine = $_POST["godine"];
    $spol = $_POST["spol"];

    $prijava_ID = $_COOKIE["prijava_ID"];
    $skupina_ID = $_COOKIE["skupina_ID"];
    $id = $_COOKIE["id"];

    $veza = new Baza(); 
    $veza->spojiDB();

    $upit = "INSERT INTO `dijete` (`OIB_dijete`, `ime_djeteta`, `prezime_djeteta`, `godine`, `spol`, `slika`, `skupina_ID`, `prijava_ID`, `korisnik_ID`) VALUES ('{$oib}', '{$ime_djeteta}', '{$prezime_djeteta}', '{$godine}', '{$spol}', '{$ime_dat}', '{$skupina_ID}', '{$prijava_ID}', '{$id}');";
    $rezultat = $veza->updateDB($upit);

    $veza->zatvoriDB();
}

?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Dovrsi prijavu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>



<body>
    <header>
        <?php
            include "../meni.php";
        ?>
    </header>

    <div class="vrtic-container">
        <div class="vrtic-content"> 
            <h2>Upiši dijete</h2>
            <form novalidate enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-dijete">
                    <label for="oib">OIB djeteta:</label>
                    <input type="number" id="oib" name="oib" min="11" max="11">
                </div>    
                <div class="form-dijete">
                    <label for="ime_djeteta">Ime djeteta:</label>
                    <input type="text" id="ime_djeteta" name="ime_djeteta">
                </div>

                <div class="form-dijete">
                    <label for="prezime_djeteta">Prezime djeteta:</label>
                    <input type="text" id="prezime_djeteta" name="prezime_djeteta">
                </div>

                <div class="form-dijete">
                    <label for="godine">Godine djeteta:</label>
                    <input type="number" id="godine" name="godine">
                </div>

                <div class="form-dijete">
                    <label for="spol">Spol:</label>
                    <select id="spol" name="spol" class="dropdown">
                        <option value="M">Muško</option>
                        <option value="Z">Žensko</option>
                    </select>
                </div>
                
                <div class="form-dijete">
                    <label>Dodaj Sliku: </label>
                    <input type="file" id="slika" name="slika">
                </div>

                <div class="form-dijete">
                    <input type="submit" name="submit" id="submit" value="Upiši" class="plava-tipka">
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