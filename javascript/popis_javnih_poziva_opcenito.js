$(document).ready(function(e){
    items="";
    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{popis_javnih_poziva_opcenito:"uspjeh"},
        success:function(data){
            console.log(data);
            $.each(data, function(index, item) {
                var tijelo = '<tr><td>' + item.ime_vrtica + '</td><td>' + item.broj_mjesta + '</td><td>' + item.datum_vrijeme_pocetak + '</td><td>' + item.datum_vrijeme_kraj + '</td></tr>';
                $("table tbody").append(tijelo);
            });
        }
    });

    $("#filter_vrtic_button").on("click", function(){
        var vrtic_ime = $("#filter_vrtic").val();
        if(vrtic_ime != ""){
            $.ajax({
                type:'POST',
                url:'../server.php',
                dataType: "json",
                data:{filter_vrtic:vrtic_ime},
                success:function(data){
                    $("table").find("tbody").empty();
                    $.each(data, function(index, item) {
                        var tijelo = '<tr><td>' + item.ime_vrtica + '</td><td>' + item.broj_mjesta + '</td><td>' + item.datum_vrijeme_pocetak + '</td><td>' + item.datum_vrijeme_kraj + '</td></tr>';
                        $("table tbody").append(tijelo);
                    });
                   
                }
            });
        }
    });

    $("#sort_vrtic_pocetak").on("click", function(){
        $.ajax({
            type:'POST',
            url:'../server.php',
            dataType: "json",
            data:{sort_vrtic_p:"uspjeh"},
            success:function(data){
                $("table").find("tbody").empty();
                $.each(data, function(index, item) {
                    var tijelo = '<tr><td>' + item.ime_vrtica + '</td><td>' + item.broj_mjesta + '</td><td>' + item.datum_vrijeme_pocetak + '</td><td>' + item.datum_vrijeme_kraj + '</td></tr>';
                    $("table tbody").append(tijelo);
                });
                
            }
        });
});

    $("#sort_vrtic_kraj").on("click", function(){
        $.ajax({
            type:'POST',
            url:'../server.php',
            dataType: "json",
            data:{sort_vrtic_k:"uspjeh"},
            success:function(data){
                $("table").find("tbody").empty();
                $.each(data, function(index, item) {
                    var tijelo = '<tr><td>' + item.ime_vrtica + '</td><td>' + item.broj_mjesta + '</td><td>' + item.datum_vrijeme_pocetak + '</td><td>' + item.datum_vrijeme_kraj + '</td></tr>';
                    $("table tbody").append(tijelo);
                });
                
            }
        });
    });
  
});