

//cuando se pulsa el icono de mensaje 
$(document).ready(function () {


    //cuando pulsa en el boton ficha empleado
    $(".ficha").on("click", function (event) {

        
        let objectClick = event.target; //guardo el objeto donde hago click

        let idEmployee = objectClick.getAttribute('data-id');//guardo la id del empleado al que se le manda el mensaje
        
        
        //con ajax se hace la petición al contrrolador que devuelve los datos
        //del empleado y los añade al dom del popup
         $.ajax({
             
            // la URL para la petición
            url : 'index.php?controller=employee_controller&action=getFicha',

            // la información de la id a borrar
            data : 'idEmployee='+idEmployee,

            // especifica si será una petición POST o GET
            type : 'POST',
            
 
            // código a ejecutar si la petición es satisfactoria
            success : function(data) {
                
                
                //del documento data que devuelve lo guardo en un array 
                //los primeros indices son la información del método
                
                let ficha = data.split(',');
                
                $("#nombreEmpleado").html(ficha[0]);
                
                $("#departEmpleado").html(ficha[1]);
                
                $("#emailEmpleado").html(ficha[2]);
  
                $("#fotoEmployee").attr('src', ficha[3]);

                

            },
            
            error: function(){
                alert('error');
            }

        });


    });
    
    
});



