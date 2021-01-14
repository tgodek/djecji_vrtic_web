$(document).ready(function(e){
    items="";
    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{prosjek:"uspjeh"},
        success:function(data){
            console.log(data);
            $.each(data, function(index, item) {
                var galerija = '<form method="post" action="galerija.php"> <input type="submit" name="submit_galerija" id="submit_galerija" value="Galerija" class="plava-tipka"> <input type="hidden" name="vrtic_ID_galerija" id="vrtic_ID_galerija" value='+item.vrtic_ID+'></form>';

                var tijelo = '<tr><td>' + item.ime_vrtica + '</td><td>' + item.lokacija + '</td><td>' + item.prosjek + '</td><td>' + galerija + '</td></tr>';
                $("table tbody").append(tijelo);
            });
        }
    });
   
});