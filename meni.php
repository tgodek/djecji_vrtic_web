<?php

    echo"
        <nav class=\"glavni-container\">
                    <div class=\"navigacija-container\">
                        <div class=\"center-min-ekran\">
                            <a href=\"$putanja/index.php\">
                                <img src=\"$putanja/multimedija/logo.png\" alt=\"\" class=\"logo\">
                            </a>
                        </div>
                        <ul>
                            <li>
                                <a href=\"$putanja/index.php\">Početna</a>
                            </li>
                            <li>
                                <a href=\"$putanja/ostalo/o_autoru.php\">O autoru</a>
                            </li>
                            
                            <li>
                                <a href=\"$putanja/ostalo/dokumentacija.php\">Dokumentacija</a>
                            </li>

                            <li>
                                <a href=\"$putanja/ostalo/popis_vrtica.php\">Popis vrtića</a>
                            </li>
                            <li>
                                <a href=\"$putanja/ostalo/popis_javnih_poziva_opcenito.php\">Popis javnih poziva</a>
                            </li>
    ";

    if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] == 1){
        echo"
            <li>
                <a href=\"$putanja/obrasci/vrtic.php\">Vrtići</a>
            </li>
        ";
    }

    if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] == 2){
        echo"
            <li>
                <a href=\"$putanja/obrasci/skupine.php\">Skupine</a>
            </li>
            <li>
            <a href=\"$putanja/obrasci/popis_prijava_moderator.php\">Popis prijava</a>
        </li>
        ";
    }

    if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] == 3){
        echo"
            <li>
                <a href=\"$putanja/obrasci/prijava_djeteta.php\">Prijava djeteta</a>
            </li>

            <li>
                <a href=\"$putanja/obrasci/popis_prijava.php\">Popis prijava</a>
            </li>
        ";
    }


    if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] > 3){
        echo"
            <li>
                <a href=\"$putanja/registracija.php\">Registracija</a>
            </li>

            <li>
                <a href=\"$putanja/prijava.php\" class=\"prijava-gumb\">Prijava</a>
            </li>
        ";  
    }

    if(isset($_SESSION["uloga"])&& $_SESSION["uloga"] < 4){
        echo"
            <li class=\"odjava-li\">
                <form method=\"post\" action=\"$putanja/prijava.php\">
                    <input type=\"submit\" id=\"odjava\" name=\"odjava\" value=\"Odjava\" class=\"odjava-gumb\">
                </form>
            </li>
        ";
    }

echo"
    </ul>
    </div>
    </nav>
";
?>