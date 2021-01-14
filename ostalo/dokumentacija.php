<?php
$putanja = dirname($_SERVER["REQUEST_URI"],2);
require "../sesija.class.php";

Sesija::kreirajSesiju();
    if(!isset($_SESSION["uloga"])){
        $_SESSION["uloga"] = 4;
    }


?>
<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Dokumentacija</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="TG">
    <meta name="keywords" content="vrtic, WebDiP, projekt">
    <meta name="description" content="Pocetna stranica">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../css/tgodek.css" rel="stylesheet" type="text/css" />
    <link href="../css/tgodek_prilagodbe.css" rel="stylesheet" type="text/css" />
</head>



<body>
    <header>
        <?php
            include "../meni.php";
        ?>
    </header>

    <div class="dokumentacija_container">
        <h2>Dječji vrtići</h2>
        <h3>Kratak opis projekta:</h3>
        <p>Sustav za upravljanje prijava u programe dječjih vrtića i rangiranje dječjih vrtića prema uspješnosti.</p> 
        <p>Uloge: Neregistrirani korisnik, Registrirani korisnik / Roditelj, Moderator / Voditelj, Administrator</p> 
        <p>Detaljne upute:</p> 
        <p><b>Administrator</b></p> 
        
        <p>Kreira dječje vrtiće (npr. Suncokret, Tikvica, …) i dodjeljuje moderatore dječjem vrtiću. Jedan
        moderator je zadužen za jedan vrtić. Kod unosa mora unijeti naziv i adresu vrtića.</p>
        <p>Vidi ukupan broj djece po vrtiću sa brojem plaćenih i neplaćenih računa.</p>
        <p>Svaki mjesec može unijeti ocjenu za rad dječjeg vrtića u skali od 1 do 10.</p>

        <p><b>Moderator / Voditelj</b></p>

        <p>Kreira skupine (npr. pred škola, jaslice, …) u vrtiću uz navođenje cijene na mjesečnoj razini.</p>
        <p>Kreira javni poziv za upise gdje definira broj mjesta i razdoblje (od-do) kada su mogući upisi. Poziv se može mijenjati do datuma početka.</p>
        <p>Vidi popis prijava za upise. Nakon roka za prijave može kliknuti na gumb kojim se automatski
            prihvaćaju prijave po principu tko prvi njegovo. Ukoliko je bilo više prijava nego definiranih
            mjesta tada se ostatak označava sa statistom na listi čekanja.</p>
        <p>Evidentira dolazak djeteta u dječji vrtić i svaki mjesec može izdati račun. Finalni iznos za neki
                mjesec se umanjuje za 10kn po danu kada dijete nije došlo u vrtić.</p>
        <p>Pregledava statistike plaćenih/neplaćenih računa svojeg vrtića za razdoblje (od-do) po
            skupini.</p>
      
        
        <p><b>Registrirani korisnik / Roditelj</b></p>

        <p>Može poslati prijavu za upis djeteta u dječji vrtić pri čemu obavezno odabire skupinu.</p>
        <p>Vidi popis prijava za upisom s informacijom da li mu je dijete prihvaćeno ili se nalazi na listi
        čekanja.</p>
        <p>Nakon što je prijava prihvaćena može odustati od prijave ili dovršiti upis u vrtić unosom
        osobnih podataka djeteta: ime, prezime, godina, spol i slike uz potvrdu za slobodno
        korištenje osobnih podataka. Ako odustane od prijave automatski se prvom sljedećem na listi
        čekanja mijenja status u prihvaćen.</p>
        <p>Vidi popis dolazaka djeteta u dječji vrtić po mjesecima.</p>
        <p>Vidi popis računa i može ga označiti da je plaćen.</p>
        <p></p>
        
        <p><b>Neregistrirani korisnik</b></p>
        <p>Vidi popis dječjih vrtića zajedno s prosječnom ocjenom dječjeg vrtića za zadnja tri mjeseca.</p>
        <p>Odabirom vrtića vidi galeriju slika (album) koja uključuje osobne podatke iz prijava u dječji
        vrtić. Ako nije dana suglasnost od roditelja slika se ne prikazuje.</p>

        <p>Može pretraživati javne pozive za upis uz mogućnost filtriranja po dječjem vrtiću i sortiranja
        po razdoblju upisa (od ili do).</p>

        <h3>Opis projektnog rješenja</h3>
        <p>Ovo rješenje donosi većinu funkcionalnosti definirano u projektonom zadatku.</p>
        <p>Dizajn aplikacije je prilagođen malim i velikim ekranima što ga čini responzivnim.</p>
        <p>Svi zapisi iz tablica su dohvaćeni preko ajax poziva, te svi upisi preko formi se direktno unose u bazu podataka</p>
        <p>Svaka uloga ima sebi posebne stranice koje im omogućuju interakciju s aplikacijom te nek zajedničke stranie koje dijeli sa svim ostalim ulogama.</p>
        <p>U nastavku možete vidjeti ERA model modeliran za ovaj sustav.</p>
        <h2>ERA model</h2>
        <img src="../multimedija/ERA_vrtic.png" alt="">
        <h3>Kratak opis ERA modela:</h3>
        <p>Tablica korisnik sadrži osnovne informacije o svim korisnicima. Tablica uloga definira koju ulogu ima koji korisnik(admin, voditelj, roditelj, neregistriran). Tablica vrtic ima informacije o vrtiću koji moderator je dodjeljen za vrtić.</p>
        <p>Tablica skupine sadrži sve skupine za određeni vrtić i definirano je koji voditelj je kreirano skupinu. Tablica ocjena vrtića sadrži ocjenu po mjesecu za odabrani vrtić.</p>
        <p>Tablicu javni poziv kreira voditelj i definira datum od kad do kad je moguće napraviti prijavu. Spojen je na tablicu prijava jedan na više jer jedan roditelj može napraviti više prijava. U status prijavu u tablici prijava automatski se dodjeljuje vrijednost "u tijeku."</p>
        <p>Voditelj kasnije po isteku roka mijenja tu vrijednost na pritisak gumba u aplikaciji. Nakon toga roditelj ispunjava obrazac preko kojeg se podaci upisuju u tablicu dijete.</p>
        <p>Korisnik roditelj za svaki mjesec ispunjava tablicu račun i u kojem se nalazi oznaka statusa računa tako da voditelj i admin znaju da li je račun plaćen. Tablica evidencija_dolazaka sadrži podatke o evidenciji dolazaka djeteta u vrtić na dnevnoj bazi.</p>
        <p>Tablica dnevnik sadrži zapise osnovnih radnji korisnika na sustavu, a tablica tip tip radnje.</p>
        <h2>Navigacijski dijagram</h2>
        <div>
            <img src="../multimedija/neregistrirani_korisnik.png" alt="">
            <img src="../multimedija/roditelj.png" alt="">
            <img src="../multimedija/voditelj.png" alt="">
            <img src="../multimedija/administrator.png" alt="">
        </div>
        <h3>Popis datoteka i skripata:</h3>
        <p><b>css</b><br>|---tgodek_prilagodbe.css<br>|---tgodek.css<br><b>galerija</b><br>|---slika.jpg<br><b>javascript</b>
        <br>|---javni_poziv.js<br>|---ocjena_vrtica.js<br>|---popis_javnih_poziva_opcenito.js<br>|---popis_javnih_poziva.js<br>|---popis_prijava_moderator.js<br>|---popis_prijava.js
        <br>|---popis_skupina.js<br>|---popis_vrtica_admin.js<br>|---popis_vrtica.js<br>|---prijava_cekanje.js<br>|---prijava_djeteta.js<br>|---prijava.js<br>|---javni_poziv.js<br>|---registracija.js<br>|---javni_poziv.js<br>|---vrtic.js<br>
        <b>multimedija</b><br>|---administrator.png<br>|---autor.jpg<br>|---ERA_vrtic.png<br>|---footer.png<br>|---logo.png<br>|---naslovna.png<br>|---neregistrirani_korisnik.png
        <br>|---roditelj.png<br>|---voditelj.png<br>|---zaboravljena-lozinka.png <br>
        <b>obrasci</b><br>|---dovrsi_prijavu.php<br>|---javni_poziv.php<br>|---ocjena_vrtica.php<br>|---popis_javnih_poziva.php<br>|---popis_prijava_moderator.php<br>|---popis_prijava.php
        <br>|---popis_skupina.php<br>|---popis_vrtica_admin.php<br>|---prijava_dijete_form.php<br>|---prijava_djeteta.php<br>|---skupine.php<br>|---tablica_djece.php<br>|---vrtic.php <br>
        <b>ostalo</b><br>|---dokumentacija.php<br>|---galerija.php<br>|---o_autoru.php<br>|--popis_javnih_poziva_opcenito.php<br>|---popis_skupina.js<br>|---popis_vrtica.php <br>
        baza.class.php <br>index.php<br>meni.php<br>postavi_vrijeme_aplikacije.php<br>prijava.php<br>registracija.php<br>server.php<br>sesija.class.php<br>vrijeme_aplikacije.php</p>

        <p>U mapi css nalaze se css datoteke. Datoteka tgodek.css upute za osnovni dizajn aplikacije, a tgodek_prilagodbe.css sadži upute dizajna za različite širine ekrana.</p>
        <p>Mapa galerija sadrži slike koje je roditelj uploadao tijekom prijave djeteta u vrtić. Mapa javascript sadrži sve javascript datoteke koje se koriste u aplikaciji. Sve js datoteke koriste jquery i ajax za slanje zahtjeva prema bazi i ograničenja u slanju obrazaca</p>
        <p>Mapa multimedija sadrži sve slike koje se koriste na stranici. Mapa obrasci sadrži sve obrasce osim prijave i registracije u aplikaciji te sve stranice u kojima se prikazivaju tablice.</p>
        <p>Mapa ostalo sadrži stranice koje su dostupne svim ulogama. Datoteka baza.class.php sadži funkcije za rad s bazom, index.php je početna stranica, meni.php sadrži glavni navigacijski prozor.</p>
        <p>Datoteka postavi_vrijeme_apkacije.php i vrijeme_aplikacije.php sadrži kod za rad s virtualnim vremenom. </p>
        <p>Datoteke prijava.php i registracija.php služe za prijavu i registraciju u sustav, a server.php sadrži sve odgovore od baze na dani ajax upit.</p>

        <h3>Popis korištenih tehnologija, alata, biblioteka:</h3>
        <p>U ovom projektu je korišten php jezik za poslužiteljsku stranu, html jezik za izradu hypertext dokumenata, jquery javascript biblioteka koja se koristila za stranu klijenta te ajax za komunikaciju s bazom podataka.</p> 
        Od alata za izradu web aplikacije koristio sam visual studio code za pisanje programskog jezika. Za testiranje aplikacije na serveru koristio sam XAMPP, a za SUBP sam koristio PHPMyAdmin.
        Program FIleZillu sam koristio kako bi uploadao sve datoteke i mape na barka.foi.hr, a program Putty kako bi se spojio na svoju mapu na barka.foi.hr. 
        Za izradu ERA modela i generiranja sql koda koristio sam MySQLWorkbench.
    </div>

    <footer>
        <p class="foter-p">KIDLER &copy; 2020 Website by</p>
        <address>
            <a href="mailto:tgodek@foi.hr">Tomislav Godek</a><br>
        </address>
    </footer>

</body>

</html>