
//cuando se pulsa acceder se compueba con ajax el método del controlador check
$(document).ready(function(){   

    //Cuando el formulario con ID acceso se envíe...
    $("#acceso").on("click", function (event) {

        var user = $('#user').val();
        var pass = $('#pass').val();


        $.ajax({

            // la URL para la petición
            url: 'index.php?controller=login_controller&action=checkAcces',

            // la información de la id a borrar
            data: {'user': user, pass: pass },

            // especifica si será una petición POST o GET
            type: 'POST',

            // código a ejecutar si la petición es satisfactoria
            success: function (data) {
                
               document.location = "index.php";

            },

            error: function () {
                alert('error');
            }

        });
    });

});


//si pulsas en el salir de la sesión 
$(document).ready(function(){
   
    $('#off').on('click', function(event){ //si hace click en off
   
        $.ajax({
            
            // la URL para la petición
            url : 'index.php?controller=login_controller&action=logOff',
            
            // código a ejecutar si la petición es satisfactoria
            success: function () {

            },

         
            error: function(){
                alert('error');
            }

        });
       
    });
});


//si pulsas en registrar nuevo usuario aparece un nuevo form 
$(document).ready(function(){
   
    $('#newUser').on('click', function(event){ //si hace click en registrar
        
        $('#register').removeClass('visibility');
        $('#newUser').addClass('visibility');
    
    });
});



//si pulsas en boton registrar con ajax llama al método del controlador 
$(document).ready(function () {

    $('#buttonRe').on('click', function (event) { //si hace click en registrar

        let newName = $('#newName').val();
        let newUser = $('#newUserRe').val();
        let newPass = $('#newPass').val();
        let select = document.getElementById('certification').value;
        
        //si se ha seleccionado un departamento
        if(select !== 'Selecciona' && newName!=="" && newUser!=="" && newPass!==""){
              

        $.ajax({

            // la URL para la petición
            url: 'index.php?controller=login_controller&action=addRegister',

            // la información de la id a borrar
            data: {'newName': newName, 'newUser': newUser, 'newPass': newPass, 'select': select},
            
             // especifica si será una petición POST o GET
            type: 'POST',

            // código a ejecutar si la petición es satisfactoria
            success: function (data) {
                

                alert('usuario creado');
                
                $('#registerOk').text('Registro OK');
                $('#register').addClass('visibility');
                  

            },

            error: function () {
                alert('error');
            }

        });
        
            
        }else{
            
            
            alert('Los campos de registro no pueden estar vacíos');
        }



    });
});









//
//
//$.ajax({
//    //Definimos la URL del archivo al cual vamos a enviar los datos
//    url: "index.php?controller=login_controller&action=checkAcces&user=" + user + "&pass=" + pass, //controlador y método 
//    //Definimos el tipo de método de envío
//    type: "POST",
//
//    // código a ejecutar si la petición es satisfactoria
//    success: function (data) {
//
//        alert(data);
//
//        document.location = "index.php?controller=employee_controller&action=list";
//
//
//    },
//
//    error: function () {
//        alert('error');
//    }
//
//});
