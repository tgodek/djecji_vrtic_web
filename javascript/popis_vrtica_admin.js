$(document).ready(function(e){
    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{popis_vrtica_admin:"uspjeh"},
        success:function(data){
            console.log(data);
            $.each(data, function(index, item) {
                var tijelo = '<tr><td>' + item.ime_vrtica + '</td><td>' + item.lokacija + '</td><td>' + item.ime_korisnika + " "+ item.prezime_korisnika + '</td></tr>';
                $("table tbody").append(tijelo);
            });
        }
    });

});