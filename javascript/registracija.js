$(document).ready(function(){
    var naslov = $(document).find('title').text();
    switch (naslov) {

        case 'Registracija':
            $("#korime").keyup(function () {
                var korime = $("#korime").val();
                if(korime != '') {
                    $.ajax({
                        type:'POST',
                        url:'server.php',
                        dataType: "json",
                        data:{korime:korime},
                        success:function(data){
                            if(data.status == 'ok'){
                                console.log("uspjeh");
                                $("#korime").css("border","2px solid red");
                                $("#zauzetoKorIme").show();
                            }
                            else{
                                console.log("neuspjeh");
                                $("#korime").css("border","2px solid green");
                                $("#zauzetoKorIme").hide();
                            }
                        }
                    });
                }
               
            });

            var slova = new RegExp(/^([A-Z][a-zčćšđž]{1,15})$/);
            var korimeTest = new RegExp(/^([a-z0-9]{2,21})$/);
            var emailTest = new RegExp(/^(\w)+@\w+(.com||.hr)$/);
            var lozinkaTest = new RegExp(/^(?=.*[0-9])(?=.*[A-Z])(?!.*[^a-zA-Z0-9@#$^+=])(.{6,20})$/);
            var prolaz1 = false;
            var prolaz2 = false;
            var prolaz3 = false;
            var prolaz4 = false;
            var prolaz5 = false;
            var prolaz6 = false;
        
            $('#registracija-form').submit(function(e) {
                var ime = $('#ime').val();
                var prezime = $('#prezime').val();
                var korime = $('#korime').val();
                var email = $('#email').val();
                var lozinka = $('#lozinka').val();
                var potvrda = $('#potvrda').val();
              

                if(slova.test(ime) == false)
                {
                    $("#ime").css("border","2px solid red");
                    $("#greska1").show();
                    prolaz1 = false;
                }
                else {
                    $("#ime").css("border","1px solid black");
                    $("#greska1").hide();
                    prolaz1 = true;
                }
                if(slova.test(prezime) == false)
                {
                    $("#prezime").css("border","2px solid red");
                    $("#greska2").show();
                    prolaz2 = false;
                }
                else{
                    $("#prezime").css("border","1px solid black");
                    $("#greska2").hide();
                    prolaz2 = true;
                }

                if(korimeTest.test(korime) == false)
                {
                    $("#korime").css("border","2px solid red");
                    $("#greska3").show();
                    prolaz3 = false;
                }
                else{
                    $("#korime").css("border","1px solid black");
                    $("#greska3").hide();
                    prolaz3 = true;
                }

                if(emailTest.test(email) == false)
                {
                    $("#email").css("border","2px solid red");
                    $("#greska4").show();
                    prolaz4 = false;
                }
                else{
                    $("#email").css("border","1px solid black");
                    $("#greska4").hide();
                    prolaz4 = true;
                }

                if(lozinkaTest.test(lozinka) == false)
                {
                    $("#lozinka").css("border","2px solid red");
                    $("#greska5").show();
                    prolaz5 = false;
                }
                else{
                    $("#lozinka").css("border","1px solid black");
                    $("#greska5").hide();
                    prolaz5 = true;
                }

                if(potvrda == "" || potvrda != lozinka)
                {
                    $("#potvrda").css("border","2px solid red");
                    $("#greska6").show();
                    prolaz6 = false;
                }
                else{
                    $("#potvrda").css("border","1px solid black");
                    $("#greska6").hide();
                    prolaz6 = true;
                }

                

                if(prolaz1 == false || prolaz2 == false || prolaz3 == false || prolaz4 == false || prolaz5 == false || prolaz6 == false)
                {
                    e.preventDefault();
                }
              });
            break;
    }
  });