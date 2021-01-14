$(document).ready(function(e){
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
    var vrtic_ID_cookie = getCookie("vrtic");
    var items="";
    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{skupina:vrtic_ID_cookie},
        success:function(data){
            console.log(data);
            $.each(data,function(index,item) 
              {
                  items += "<option value=" + item.skupina_ID + " > "+ item.naziv_skupine +"</option>";
              });
              $("#skupine").html(items);
          }
    });
  });