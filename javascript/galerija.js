$(document).ready(function(e){
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
    var vrtic_galerija_cookie = getCookie("vrtic_galerija");
    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{galerija:vrtic_galerija_cookie},
        success:function(data){
            console.log(data);
            $.each(data, function(index, item) {
                var slika_djeteta = '../galerija/'+item.slika;
                var tijelo = '<tr><td>' + item.OIB_dijete + '</td><td>' + item.ime_djeteta + '</td><td>' + item.prezime_djeteta + '</td><td>' + item.godine + '</td><td>' + item.spol + '</td><td><img src="'+ slika_djeteta +'" alt="slika_djeteta" style="max-width:200px"></td></tr>';
                $("table tbody").append(tijelo);
            });
          }
    });
  });