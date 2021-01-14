$(document).ready(function(e){
    items="";
    $.ajax({
        type:'POST',
        url:'../server.php',
        dataType: "json",
        data:{ocjena:"uspjeh"},
        success:function(data){
            console.log(data);
            $.each(data,function(index,item) 
            {
                items += "<option value=" + item.vrtic_ID + " > "+ item.ime_vrtica + "</option>";
            });
            $("#vrtic").html(items);
        }
    });

});