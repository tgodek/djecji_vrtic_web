$(document).ready(function(e){
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
    var korisnik_ID_cookie = getCookie("id");
    console.log(korisnik_ID_cookie);

    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{prijave_moderator:korisnik_ID_cookie},
        success:function(data){
            console.log(data);
            $.each(data, function(index, item) {
                var trenutno = new Date($.now());
                var bazaDate = new Date(item.datum_vrijeme_kraj);
                if(bazaDate < trenutno)
                {
                    var link ='<form method="post" action="popis_prijava_moderator.php"> <input type="submit" name="odobri_zahtjev" id="odobri_zahtjev" value="Odobri" class="plava-tipka"> <input type="hidden" name="javni_poziv" id="javni_poziv" value='+item.javni_poziv_ID+'></form>';
                }
                else{
                    var link = "";
                }
                var tijelo = '<tr><td>' + item.datum_vrijeme_kraj + '</td><td>' + item.datum_prijave + '</td><td>' + item.status_prijave + '</td><td>' + item.ime_korisnika + " " + item.prezime_korisnika + '</td><td>' + link + '</td></tr>';
                $("table tbody").append(tijelo);
            });
        }
    });

  
});