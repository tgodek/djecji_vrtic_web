$(document).ready(function(e){
  var items="";
  $.ajax({
      type:'POST',
      url:'../server.php',
      dataType: "json",
      data:{korisnik:"uspjesno"},
      success:function(data){
          console.log(data);
          $.each(data,function(index,item) 
            {
                items += "<option value=" + item.korisnik_ID + " > "+ item.ime_korisnika + " " + item.prezime_korisnika +"</option>";
            });
            $("#moderator").html(items);
        }
  });
});