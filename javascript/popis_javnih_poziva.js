$(document).ready(function(e){
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
    var korisnik_ID_cookie = getCookie("id");
    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{popis_javnih_poziva:korisnik_ID_cookie},
        success:function(data){
            console.log(data);
            $.each(data, function(index, item) {
                var tijelo = '<tr><td>' + item.broj_mjesta + '</td><td>' + item.datum_vrijeme_pocetak + '</td><td>' + item.datum_vrijeme_kraj + '</td></tr>';
                $("table tbody").append(tijelo);
            });
        }
    });
  
});