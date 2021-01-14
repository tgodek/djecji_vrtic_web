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
        data:{prijave:korisnik_ID_cookie},
        success:function(data){
            console.log(data);
            $.each(data, function(index, item) {
                if(item.status_prijave == "odobren"){
                    var dovrsi ='<form method="post" action="dovrsi_prijavu.php"> <input type="submit" name="dovrsi_prijavu" id="dovrsi_prijavu" value="Dovrsi prijavu" class="plava-tipka"> <input type="hidden" name="skupina_ID" id="skupina_ID" value='+item.skupina_ID+'> <input type="hidden" name="prijava_ID" id="prijava_ID" value='+item.prijava_ID+'></form>';
                    var izbrisi ='<form method="post" action="popis_prijava.php"> <input type="submit" name="izbrisi_prijavu" id="izbrisi_prijavu" value="Izbrisi prijavu" class="plava-tipka"> <input type="hidden" name="prijava_ID" id="prijava_ID" value='+item.prijava_ID+'></form>';
                }
                else{
                    var dovrsi ="";
                    var izbrisi ="";
                }
                var tijelo = '<tr><td>' + item.datum_prijave + '</td><td>' + item.status_prijave + '</td><td>' + dovrsi + '</td><td>' + izbrisi + '</td></tr>';
                $("table tbody").append(tijelo);
            });
        }
    });
  
});