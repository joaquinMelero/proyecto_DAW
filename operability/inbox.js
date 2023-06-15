$(document).ready(function () {
    
    //si se pulsa en historial de tareas
    listarHistorial();
    
   //al pulsar btn filtar solo aparecen las tareas pendientes de ese empleado
   filtrarNombre();
   

$('.check').on('change', function(event){ //si se produce cambio en elemento con la clase check
    
     let objectClick = event.target; //guardo el objeto donde hago click

     let idMessage = objectClick.getAttribute('data-id');//guardo la id del td de la fila donde se ha pulsado el checkbox
     
    
    if($(this).is(':checked')){//si este elemento se encuentra checked
            
        // la guardo en el array el nombre y tarea
        
        let mensaje  = $('#'+idMessage).html();
         
         $('#'+idMessage).addClass('tachado'); //se tacha la tarea
        
        idMessage= idMessage.slice(3); //guardo el id, obvio el td_
        
        let nombre  = $('#th_'+idMessage).html(); //guardo el nombre
        
        
        
        //borro de la db la tarea con jquery.ajax realizando la peticion al http al controller message
          $.ajax({

            // la URL para la petición
            url: 'index.php?controller=message_controller&action=completeMessage',

            // la información de la id a borrar
            data: {'idMessage': idMessage},

            // especifica si será una petición POST o GET
            type: 'POST',

            // código a ejecutar si la petición es satisfactoria
            success: function (data) {
    
                 $('#p_'+idMessage).removeClass('visibility'); //hago visible los iconos y checked si esta realizada
                 $('#span_'+idMessage).addClass('visibility'); //hago visible los iconos y checked si esta realizada
                 $('#input_'+idMessage).addClass('visibility'); //hago visible los iconos y checked si esta realizada
 
            },

            error: function () {
                alert('error');
            }

        });
        
    }
    
});

});
 

//función que hace visible en el dom la tabla con tareas comletadas
function listarHistorial(){
    
      $('#historial').on('click', function(event){
          
          $('#tablaHistorial').removeClass('visibility');
          
      });
}

//método que al pulsar en btn filtar recorre la tabla y borra las filas que no tengan el nombre del select
function filtrarNombre(){
    $('#btnFiltrar').on('click', function(event){
       
        //al pulsar en btn filtar solo muestro en la tabla los nombres iguales al
        //option del select
        
        const resume_table = document.getElementById("table1");//guardo elemento tabla
        
        //filas de la tabla
        //Selecciono todos los elemntos con la clase rowFila que estan dentro tr de la tabla id(table1)
        const tableRows = document.querySelectorAll('#table1 tr.rowTable');//within the document that matches the specified selector, or group of selectors

        
        for(let i=0; i<tableRows.length; i++) {//recorro las filas
            
            let row = tableRows[i]; //guardo la fila en varible row

            //si el td del nombre no es igual al select se eliminan las filas
            if(row.querySelector('.nameRow').innerText !== $("#nameEmployee option:selected").text()){
               row.remove(); //elimino la fila 
            }
           

        }
       
    });
}

