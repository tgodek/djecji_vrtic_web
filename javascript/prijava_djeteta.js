$(document).ready(function(e){
    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{natjecaj:"natjecaj"},
        success:function(data){
            console.log(data);
            $.each(data, function(index, item) {
                var trenutno = new Date($.now());
                var bazaDate = new Date(item.datum_vrijeme_kraj);

                if(bazaDate > trenutno)
                {
                    var link ='<form method="get" action="prijava_dijete_form.php"> <input type="submit" name="submit_zahtjev" id="submit_zahtjev" value="Prijava" class="plava-tipka"> <input type="hidden" name="javni_poziv" id="Javni_poziv" value='+item.javni_poziv_ID+'> <input type="hidden" name="vrtic_ID_value" id="vrtic_ID_value" value='+item.vrtic_ID+'></form>';
                }
                else{
                    var link = "";
                }
                var tijelo = '<tr><td>' + item.ime_vrtica + '</td><td>' + item.broj_mjesta + '</td><td>' + item.datum_vrijeme_pocetak + '</td><td>' + item.datum_vrijeme_kraj + '</td><td>'+ link +'</td></tr>';
                $("table tbody").append(tijelo);
            });
        }
    });
  
});