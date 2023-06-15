/* 
 * Archivo específico para el código js de la vista Empleados view
 */

$(document).ready(function(){
    
   pressTareas();//si pulsa en el icono lista tareas te lleva a la vista
   
    $('.borrar').on('click', function(event){
        
        
        var option = event.target; //guardo el objeto donde hago click
        
        var location = option.getAttribute('data-set'); //guardo el id del registro a eliminar

        $.ajax({
            
            
            // la URL para la petición
            url : 'index.php?controller=employee_controller&action=deletejs',

            // la información de la id a borrar
            data : 'variable='+location,

            // especifica si será una petición POST o GET
            type : 'POST',


            // código a ejecutar si la petición es satisfactoria
            success : function(data) {
                
                swal("¡Empleado Eliminado!", ":(", "warning");
                
                //si la id se ha guardado puedo eliminar la fila del dom 
                $("#"+location).remove();


            },
            
            error: function(){
                alert('error');
            }

        });
       
    });
});

//método que a lpulsar en elicono de tareas pendientes te lleva a la vista de tareas
function pressTareas(){
    
     $('.listaTarea').on('click', function(event){
      
         document.location = "http://localhost/Group_Manager/index.php?controller=message_controller&action=inbox";
         
         
     });
    
}
