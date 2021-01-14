<?php
    $putanja = dirname($_SERVER["REQUEST_URI"]);
    require "baza.class.php";
    require "sesija.class.php";

    Sesija::kreirajSesiju();
    if(!isset($_SESSION["uloga"])){
        $_SESSION["uloga"] = 4;
    }

    if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] < 4){
        header("Location:$putanja/index.php");
    }

    if(isset($_POST["odjava"]))
    {
        if(isset($_COOKIE["id"])){
            setcookie("id", "", time() - 36000); 
        }
        session_destroy();

    }

  

    $prolaz1 = false;
    $prolaz2 = false;
    if(isset($_POST['submit'])){
        $veza = new Baza();
        $veza->spojiDB();
        $korime = $_POST['korime'];
        $lozinka = $_POST['lozinka'];

        $upit = "select * from korisnik where kor_ime='{$korime}' and lozinka='{$lozinka}'";
        $rezultat = $veza->selectDB($upit);

        $autenticiran = false;
        while($red = mysqli_fetch_array($rezultat)){
            if($red){
                $autenticiran = true;
                $tip = $red['uloga_ID'];
            }
        }

        if($autenticiran){
            Sesija::kreirajKorisnika($korime,$tip);
            $_SESSION["uloga"] = $tip;
            header("Location:index.php");
        }
        else{
            $poruka = "Neuspješna prijava, pokušajte ponovo!";
        }
        $veza->zatvoriDB();
    }
?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Prijava</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/prijava.js"></script>
</head>


<body>
    <header>
        <?php
        include "meni.php";
        ?>
    </header>

    <section class="sekcija-form-prijava">
        <form novalidate method="post" name="prijava-form" id="prijava-form" class="prijava-form" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-dijete">
                <label for="korime">Korisničko ime </label>
                <input type="text" id="korime" name="korime">
                <p class="greska" name="greskaPrijava1" id="greskaPrijava1">Unesi korisničko ime!</p>
            </div>

            <div class="form-dijete">
                <label for="lozinka">Lozinka </label>
                <input type="password" id="lozinka" name="lozinka">
                <p class="greska" name="greskaPrijava2" id="greskaPrijava2">Unesi lozinku!</p>
            </div>
        
            <div class="form-dijete">
                <input type="submit" id="submit" name="submit" value="Prijava" class="plava-tipka">
                <p class="greska" name="greskaPrijava3" id="greskaPrijava3">Neuspješna prijava</p>
            </div>
        </form>
        <div class="zab-lozinka">
            <a href="#">Zaboravljena lozinka</a>
        </div>
    </section>

    <footer>
        <p class="foter-p">KIDLER &copy; 2020 Website by</p>
        <address>
            <a href="mailto:tgodek@foi.hr">Tomislav Godek</a><br>
        </address>
    </footer>   

</body>

</html>