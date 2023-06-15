/* 
 * fichero js para mostrar campo de texto cuando se pulsa en mensaje 
 */

//cuando se pulsa el icono de mensaje 
$(document).ready(function () {

     textMessageOpen();
     
     popUp();


    //Cuando se pulsa en enviar 
    $(".enviar").on("click", function (event) {
        
        let objectClick = event.target; //guardo el objeto donde hago click

        let idEmployee = objectClick.getAttribute('data-id');//guardo la id del empleado al que se le manda el mensaje
        
        let message = $('#textArea_'+idEmployee).val();//guardo el valor del tex area
        
        let nombreEmpleado = objectClick.getAttribute('data-name');

        
        //si el mensaje no está en blanco
        if(message!=""){
        
        $.ajax({

            // la URL para la petición
            url: 'index.php?controller=message_controller&action=saveMessage',

            // la información de la id a borrar
            data: {'idEmployee': idEmployee, 'message': message, 'nombreEmpleado': nombreEmpleado },

            // especifica si será una petición POST o GET
            type: 'POST',

            // código a ejecutar si la petición es satisfactoria
            success: function (data) {
        

             swal("¡Bien!", "Has mandado la tarea :)", "success");
             
             
             $('.swal-button').click(function(){
                 
                 document.location = "index.php";
                 
             });
     
            },

            error: function () {
                alert('error');
            }

        });
        
        }else{
             swal("¡No puedes mandar una tarea en blanco!", "Inténtalo de nuevo", "error");
        }
    });
    
    
    
    
    
    //si se pulsa en cerrar en vez de enviarel mensaje
    $(".cerrar").on("click", function (event) {
        document.location = "index.php";
    });

});





//método para mostrar el text area quitando la clase 
function textMessageOpen() {

        $(".colorBrown").on("click", function (event) {
            
            let objectClick = event.target; //guardo el objeto donde hago click

            let idEmployee = objectClick.getAttribute('id');//guardo la id del empleado al que se le manda el mensaje
            
         
            $('#textMessage_'+idEmployee).removeClass('visibility');
            
        });
 
}


//función que muestra el popUp a lpulsar en el boton ficha
function popUp() {

    //cuando pulsa enel boton ficha empleado
    $(".ficha").on("click", function (event) {

        //select the POPUP FRAME and show it
        $("#popup").hide().fadeIn(1000); //El método hide() oculta los elementos seleccionados El método fadeIn() cambia gradualmente la opacidad, para los elementos seleccionados, de ocultos a visibles (efecto de desvanecimiento).

        //close the POPUP if the button with id="close" is clicked
        $("#closePop").on("click", function (e) {
            e.preventDefault(); //detiene la acción predeterminada de un elemento
            $("#popup").fadeOut(1000); //fadeOut de visible a oculto (efecto de desvanecimiento).
        });

    });
}

