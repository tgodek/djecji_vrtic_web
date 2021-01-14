$(document).ready(function(){
    var naslov = $(document).find('title').text();
    switch (naslov) {
        case 'Prijava':
            var prolaz1 = false;
            var prolaz2 = false;
            $('#prijava-form').submit(function(e) {
                var korime = $('#korime').val();
                var lozinka = $('#lozinka').val();
        
                if(korime == "")
                {
                    $("#korime").css("border","2px solid red");
                    $("#greskaPrijava1").show();
                    prolaz1 = false;
                }
                else{
                    $("#korime").css("border","1px solid black");
                    $("#greskaPrijava1").hide();
                    prolaz1 = true;
                }

                if(lozinka == "")
                {
                    $("#lozinka").css("border","2px solid red");
                    $("#greskaPrijava2").show();
                    prolaz2 = false;
                }
                else{
                    $("#lozinka").css("border","1px solid black");
                    $("#greska2").hide();
                    prolaz2 = true;
                }


                if(prolaz1 == false || prolaz2 == false)
                {
                    e.preventDefault();
                }
            });
        break;
    }
  });