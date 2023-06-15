//archivo js para comprobar que al crear un uasuario no tenga el mismo nombre
$(document).ready(function () {
    
    let usedName = "";
    
    //si se produce algún cambio en el campo nombre se comprueba con
    //ajax en la base de datos que no exits ese nombre ya, y se habilita el guardar
    $('#nameEmployeeEdit').change(function(){
        
        let valName =$('#nameEmployeeEdit').val();//guardo el valor del campo Name
            
        //hago la petición al método que comprueba si ya hay en la bd un nombre igual 
          $.ajax({

            // la URL para la petición
            url: 'index.php?controller=employee_controller&action=checkNameEmployee',

            // la información de la id a borrar
            data: {'valName': valName},

            // especifica si será una petición POST o GET
            type: 'POST',

            // código a ejecutar si la petición es satisfactoria
            success: function (data) {
                         
                usedName = data.slice(1, 2);//guardo si exist vale 1 
  
                //si está libre habilito el siguiente campo
                if (usedName.trim() != "1") {
                    
                     //si el nombre esta libre el campo puesto está disponible
                $('#puestoEmployee').attr('readonly', false);
                
                //el fondo del campo se vuelve blanco
                $('#puestoEmployee').removeClass('fondoReadOnly');
                
                
                $('#pAvisoCoin').html('');
                    
                }else{
                    //si el nombre esixte
               $('#pAvisoCoin').html('Nombre empleado ya registrado');

                }
            },

            error: function () {
                alert('error');
            }

        });


    });//fin de código comprobar si el nombre está libre en db
    
   
    //si el nombre está libre valido los demás campos

    //si el nombre no existe en la bd 
    if (usedName.trim() != "1") {//trim elimina espacios
        
        let val1 = 'ko';
        let val2 = 'ko';
        let val3 = 'ko';
  
        
        //si se produce un cambio en el campo puesto lo valido
        //si el campo está blanco val=ko y si no val=ok 
        $('#puestoEmployee').bind("keyup keydown change", function(){
        
        let puesto = $('#puestoEmployee').val();

        if ((puesto == "")) {//si el campo está en blanco no es válido
            
            $('#puestoEmployee').addClass('fondoRedForm');
            val1 = 'ko';
              
            
        } else {
            $('#puestoEmployee').removeClass('fondoRedForm');
            val1 = 'ok';
            
            //el campo email se habilita
             $('#emailEmployee').attr('readonly', false);
             
             //el fondo email pasa a blanco 
               $('#emailEmployee').removeClass('fondoReadOnly');
      }
     
        });
        
        
        //validación de campo email
         $('#emailEmployee').bind("keyup keydown change", function(){//cuando se produce un cambio en el campo email 

        //expresión regular para combrobar email 
        let expr = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

        let email = $('#emailEmployee').val();//guardo el valor del campo

        if (!expr.test(email)) {//si no es el formato adecuado
            val2 = 'ko';

            $('#emailEmployee').addClass('fondoRedForm');

        } else {
            $('#emailEmployee').removeClass('fondoRedForm');
            val2 = 'ok';
            //si está ok habilitu subir foto
              //el campo email se habilita
             $('#archivo').attr('disabled', false);

        }

    });
    
    
    //validación de foto
    $('#archivo').change(function () {

        if ($('#archivo').val() == "") {

            $('#archivo').addClass('fondoRedForm');
            val3 = 'ko';
        } else {
             $('#puestoEmployee').removeClass('fondoRedForm');
            val3 = 'ok';
        }


    });
    
   
        //cuando se produce un cambio en el form reviso si está validado 
        $('#form').change(function(){
            
            
            //si val es ok se muestra el botón guardar 
       if (val1 == 'ok' && val2=='ok' && val3=='ok') {

           $('#pBtnGuardar').removeClass('visibility');
       }else{
            $('#pBtnGuardar').addClass('visibility');
       }
            
        });

    }


});


 
    