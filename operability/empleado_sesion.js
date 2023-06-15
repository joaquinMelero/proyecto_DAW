//código js para listar las tareas según el trabajdor seleccionado 


$(document).ready(function () {
    
    
    $('#nameEmpl').on('change', function(){
    
    let empleadoSelec = $("#nameEmpl option:selected").text();//valor del option
  
    
        //realizo la petición al método que devuelve las tareas filtradas del message_controller
          $.ajax({

            // la URL para la petición
            url: 'index.php?controller=message_controller&action=listarTareasEmpleado',

            // la información de la id a borrar
            data: {'empleadoSelec': empleadoSelec},

            // especifica si será una petición POST o GET
            type: 'POST',

            // código a ejecutar si la petición es satisfactoria
            success: function (data) {
    
                //para separar el data hago un split, guardo las tareas en array y muestro
                let listaTareas = data.split('|¬');

                //si ya existe un elemento tabla de empleado que no la cree
                if ($("#tableTareas_" + empleadoSelec).length < 1) {

                    //creo la tabla para las tareas
                    $('#listaTareas').append("Tabla Tareas Incompletas:<table id='tableTareas_" + empleadoSelec + "' class='table table-bordered colorWhite'></table><br>");

                    listaTareas.pop();//elimino el resto de data

                    //muestro el nombre del empleado dentro de la tabla
                    document.getElementById("tableTareas_" + empleadoSelec).innerHTML += "<th>" + empleadoSelec + "</th>";

                    //si no hay tareas se muestran 
                    if (listaTareas.length > 0) {

                        //recorro el array y lo muestro en tr
                        listaTareas.forEach((el, index) => {
                            document.getElementById("tableTareas_" + empleadoSelec).innerHTML += "<tr><td>" + el + "</td></tr>";
                        });

                    } else {
                        document.getElementById("tableTareas_" + empleadoSelec).innerHTML += "<tr><td>Eres un crak! 0 Tareas</td></tr>";
                    }

                }
            },

            error: function () {
                alert('error');
            }

        });
    
    });
});


