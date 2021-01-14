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

    $prolaz1 = false;
    $prolaz2 = false;
    $prolaz3 = false;
    $prolaz4 = false;
    $prolaz5 = false;

    if(isset($_POST["submit"])){
        $veza = new Baza(); 
        $veza->spojiDB();
        
        foreach($_POST as $k => $v){
            if($k === "ime"){
                $uzorak = "/^([A-Z][a-zčćšđž]{1,15})$/";
                if(preg_match($uzorak,$v)){
                    $prolaz1 = true;
                }
            }
            else if($k === "prezime"){
                $uzorak = "/^([A-Z][a-zčćšđž]{1,15})$/";
                if(preg_match($uzorak,$v)){
                    $prolaz2 = true;
                }
            }
            
            else if($k === "korime"){
                $uzorak = "/^([a-z0-9]{2,21})$/";
                
                if(preg_match($uzorak,$v)){
                    $prolaz3 = true;
                }
            }

            else if($k === "email"){
                $uzorak = "/^(\w)+@\w+(.com||.hr)$/";
                if(preg_match($uzorak,$v)){
                    $prolaz4 = true;
                } 
            }

            else if($k === "lozinka"){
                $uzorak = "/^(?=.*[0-9])(?=.*[A-Z])(?!.*[^a-zA-Z0-9@#$^+=])(.{6,20})$/";
                if(preg_match($uzorak,$v)){
                    $prolaz5 = true;
                } 
            }

            else if($k === "CaptchaCode"){
                if(!empty($k)){
                   
                }
            }
        }

        if($prolaz1 === true && $prolaz2 === true && $prolaz3 === true && $prolaz4 === true && $prolaz5 === true) 
        {
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $kor_ime = $_POST["korime"];
            $email = $_POST["email"];
            $lozinka = $_POST["lozinka"];
            $sha = sha1($lozinka,false);
    
            $upit = "INSERT INTO `korisnik`(`ime_korisnika`, `prezime_korisnika`, `kor_ime`, `lozinka`, `lozinka_sha1`, `email`, `status`,`uloga_ID`) 
            VALUES ('{$ime}','{$prezime}','{$kor_ime}','{$lozinka}','{$sha}','{$email}','1','3')";
            $rezultat = $veza->updateDB($upit);
        } 
        $veza->zatvoriDB(); 
    }
?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Registracija</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/registracija.js"></script>
</head>


<body>
    <header>
        <?php
            include "meni.php";
        ?>
    </header>

    <section class="sekcija-forma">
        <div class="registracija-side">
            <div class="reg-info">
                <h2>Registracija</h2>
                <p>Registriraj se sada i odaberi<br>najbolji vrtić za vaše dijete!</p>
            </div>
        
            <div class="vec-reg">
                <a href="prijava.php" class="bijela-tipka"> Prijava</a>
                <p>Već registrirani?</p>
            </div>
           
        </div>
        <form novalidate method="post" class="registracija" name="registracija-form" id="registracija-form" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-dijete">
                <label for="ime">Ime </label>
                <input type="text" id="ime" name="ime" autofocus="autofocus"> 
                <p class="greska" name="greska1" id="greska1">Prvo slovo veliko, ostala mala</p>
            </div>

            <div class="form-dijete">
                <label for="prezime">Prezime </label>
                <input type="text" id="prezime" name="prezime">
                <p class="greska" name="greska2" id="greska2">Prvo slovo veliko, ostala mala</p>
            </div>

            <div class="form-dijete">
                <label for="korime">Korisničko ime </label>
                <input type="text" id="korime" name="korime">
                <p class="greska" name="zauzetoKorIme" id="zauzetoKorIme">Korisničko ime zauzeto!</p>
                <p class="greska" name="greska3" id="greska3">Samo slova i brojevi, sve malo zapisano</p>
            </div>

            <div class="form-dijete">
                <label for="email">E-mail </label>
                <input type="email" id="email" name="email">
                <p class="greska" name="greska4" id="greska4">Email tipa: vasemail@gmail.com</p>
            </div>

            <div class="form-dijete">
                <label for="lozinka">Lozinka </label>
                <input type="password" id="lozinka" name="lozinka">
                <p class="greska" name="greska5" id="greska5">Min 6 znakova, jedno veliko i malo slovo, jedan broj</p>
            </div>

            <div class="form-dijete">
                <label for="potvrda">Potvrda lozinke </label>
                <input type="password" id="potvrda" name="potvrda">
                <p class="greska" name="greska6" id="greska6">Nise unijeli istu lozinku</p>
            </div>

            <div class="form-dijete">
                <input type="submit" id="submit" name="submit" value="Registriraj se" class="plava-tipka">
            </div>
        </form>
    </section>

    <footer>
        <p class="foter-p">KIDLER &copy; 2020 Website by</p>
        <address>
            <a href="mailto:tgodek@foi.hr">Tomislav Godek</a><br>
        </address>
    </footer>
</body>

</html>
