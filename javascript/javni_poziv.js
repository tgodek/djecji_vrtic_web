$(document).ready(function(e){
    var items="";
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
        data:{korisnik_ID:korisnik_ID_cookie},
        success:function(data){
            console.log(data);
            $.each(data,function(index,item) 
            {
                items += "<option value=" + item.vrtic_ID + " > "+ item.ime_vrtica + "</option>";
            });
            $("#svoj_vrtic").html(items);
        }
    });

});