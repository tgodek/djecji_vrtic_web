<?php
    require("baza.class.php");

    if(!empty($_POST['korime'])){
        $data = array();

        $veza = new Baza();
        $veza->spojiDB();
        $korime = $_POST["korime"];
        $upit_korime = "select * from korisnik where kor_ime='{$korime}';";
        $rezultat = $veza->selectDB($upit_korime);
        $odgovor = mysqli_num_rows($rezultat);

        if($odgovor > 0)
        {
            $data['status'] = 'ok';
        }
        else{
            $data['status'] = 'err';
        }
        $veza->zatvoriDB();

        echo json_encode($data);
    }

    if(!empty($_POST['korisnik'])){
        $veza = new Baza();
        $veza->spojiDB();
        $upit = "select korisnik_ID, ime_korisnika, prezime_korisnika from korisnik where uloga_ID='2'";
        $rezultat = $veza->selectDB($upit);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();

        echo json_encode($data);
    }


    if(!empty($_POST['korisnik_ID'])){
        $id = $_POST['korisnik_ID'];
        $veza = new Baza();
        $veza->spojiDB();
        $upit_skupina = "select vrtic_ID, ime_vrtica from vrtic where korisnik_ID = '{$id}';";
        $rezultat = $veza->selectDB($upit_skupina);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }


    
    if(!empty($_POST['natjecaj'])){
        $veza = new Baza();
        $veza->spojiDB();
        $upit_skupina = "select ime_vrtica, javni_poziv_ID, broj_mjesta,datum_vrijeme_pocetak, datum_vrijeme_kraj,vrtic.vrtic_ID from javni_poziv,vrtic,skupina where vrtic.vrtic_ID = javni_poziv.vrtic_ID group by 2;";
        $rezultat = $veza->selectDB($upit_skupina);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }


    if(!empty($_POST['skupina'])){
        $vrtic_ID = $_POST['skupina'];
        $veza = new Baza();
        $veza->spojiDB();
        $upit_skupina = "select skupina_ID, naziv_skupine from skupina where skupina.vrtic_ID = '{$vrtic_ID}'";
        $rezultat = $veza->selectDB($upit_skupina);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    if(!empty($_POST['prijave'])){
        $korisnik = $_POST['prijave'];
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select prijava_ID, datum_prijave, status_prijave, skupina_ID, javni_poziv_ID from prijava where korisnik_ID = '{$korisnik}'";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    if(!empty($_POST['prijave_moderator'])){
        $korisnik = $_POST['prijave_moderator'];
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select prijava_ID, prijava.javni_poziv_ID, datum_vrijeme_kraj, korisnik.ime_korisnika, korisnik.prezime_korisnika , datum_prijave, status_prijave from prijava,skupina,korisnik,javni_poziv where prijava.skupina_ID = skupina.skupina_ID and skupina.korisnik_ID = '{$korisnik}' and korisnik.korisnik_ID = prijava.korisnik_ID and javni_poziv.javni_poziv_ID = prijava.javni_poziv_ID";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    if(!empty($_POST['popis_skupina'])){
        $korisnik = $_POST['popis_skupina'];
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select skupina_ID, naziv_skupine, mj_naplata from skupina where korisnik_ID = '{$korisnik}'";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }
    

    if(!empty($_POST['popis_javnih_poziva'])){
        $korisnik = $_POST['popis_javnih_poziva'];
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select javni_poziv_ID, broj_mjesta, datum_vrijeme_pocetak, datum_vrijeme_kraj from javni_poziv where korisnik_ID = '{$korisnik}'";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    
    if(!empty($_POST['popis_vrtica_admin'])){
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select vrtic_ID, ime_vrtica, lokacija, ime_korisnika, prezime_korisnika from vrtic,korisnik where korisnik.korisnik_ID = vrtic.korisnik_ID";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }


    
    if(!empty($_POST['ocjena'])){
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select vrtic_ID, ime_vrtica from vrtic";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    if(!empty($_POST['prosjek'])){
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select vrtic.vrtic_ID, ime_vrtica, lokacija, avg(ocjena) as prosjek from vrtic inner join ocjena_vrtica on vrtic.vrtic_ID = ocjena_vrtica.vrtic_ID GROUP BY ime_vrtica";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }


    if(!empty($_POST['popis_javnih_poziva_opcenito'])){
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select ime_vrtica, broj_mjesta, datum_vrijeme_pocetak, datum_vrijeme_kraj from vrtic inner join javni_poziv where vrtic.vrtic_ID = javni_poziv.vrtic_ID";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    if(!empty($_POST['filter_vrtic'])){
        $vrtic_ime = $_POST['filter_vrtic'];
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select ime_vrtica, broj_mjesta, datum_vrijeme_pocetak, datum_vrijeme_kraj from vrtic inner join javni_poziv 
        where vrtic.vrtic_ID = javni_poziv.vrtic_ID and ime_vrtica like '%{$vrtic_ime}%'";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    
    if(!empty($_POST['sort_vrtic_p'])){
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select ime_vrtica, broj_mjesta, datum_vrijeme_pocetak, datum_vrijeme_kraj from vrtic inner join javni_poziv where vrtic.vrtic_ID = javni_poziv.vrtic_ID order by datum_vrijeme_pocetak";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    if(!empty($_POST['sort_vrtic_k'])){
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select ime_vrtica, broj_mjesta, datum_vrijeme_pocetak, datum_vrijeme_kraj from vrtic inner join javni_poziv where vrtic.vrtic_ID = javni_poziv.vrtic_ID order by datum_vrijeme_kraj";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    if(!empty($_POST['galerija'])){
        $vrtic_galerija = $_POST["galerija"];
        $veza = new Baza();
        $veza->spojiDB();
        $upit_prijava = "select OIB_dijete, ime_djeteta, prezime_djeteta, godine, spol, slika from vrtic inner join skupina on vrtic.vrtic_ID = '{$vrtic_galerija}' and vrtic.vrtic_ID = skupina.vrtic_ID inner join dijete on skupina.skupina_ID = dijete.skupina_ID";
        $rezultat = $veza->selectDB($upit_prijava);

        $data = array();
        while($row = mysqli_fetch_array($rezultat)){
            $data[] = $row; 
        };

        $veza->zatvoriDB();
        echo json_encode($data);
    }

    
?>