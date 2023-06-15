
<?php
require_once 'template/header.php';
require_once 'model/message_model.php';
require_once 'model/employee_model.php';
?>

<!-- SECCIÖN FILTRAR POR BÚSQUEDAS -->

<table id='tablaFiltrar'>
    <tr><td><span id='pFiltrar'>Filtar tarea por empleado:</span></td><td> 
        <select name='nameEmployee' id="nameEmployee" class="form-select selectForm camposLogin">
        <option selected="true" disabled="disabled">seleccione un empleado</option>

        <?php
        //método que muestra las opciones del select
        namesEmployeesTareas(); 
        ?>
        
    </select>
    
</td>

    <td><button id="btnFiltrar" class="btn-filtrar2 button1">Filtrar</button></td>
        <td><button id="btnExport" class="btn-filtrar2 button1">Exportar Tabla a CSV</button></td>
        <td><button id="btnReset" class="btn-filtrar2 button1"><a href="http://localhost/Group_Manager/index.php?controller=message_controller&action=inbox">Reset</a></button></td></tr>
</table>


<!-- FIN SECCIÓN FILTRAR POR BÚSQUEDAS -->

<!-- SECCIÓN LISTAR TAREAS -->

<table id="table1" class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Mensaje</th>
            <th scope="col">Estado</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $objMessage = new message_model(); //creo un objeto model_message
        
         $mensajes = getTableMessage(); //array con la tabla mensajes

        if (count($mensajes) > 0) {

            foreach ($mensajes as $employee) {
               
                
                //si el uasuario coincide con la sesión y si las tareas estas completadas se muestarn
                if ( $employee['idUser'] == $_SESSION['id_user'] || $_SESSION['rol'] == 'admin') {
                    
                    if($employee['completado']==='no'){
                    ?>

                    <tr class="rowTable" id="<?php echo 'tr_' .$employee['id'];?>">
                        <td><img class="img-thumbnail" src="<?php   $arr = $objMessage->getFoto($employee['idUser'], $employee['nameEmployee']); echo $arr[0]['foto'];?>" width="90" height="90"></td>
                        <td id="<?php echo 'th_' .$employee['id'];?>" scope="row" class="nameRow colorWhite" style=" padding-top: 2%;"><?php echo $employee['nameEmployee']; ?></td>
                        <td id="<?php echo 'td_' .$employee['id'];?>" class="colorWhite" style=" padding-top: 2%;"><?php echo $employee['message']; ?></td>
                        <td><div class="form-check form-switch colorWhite"style="padding-left:0;  padding-top: 5%;"><span id="<?php echo 'span_' .$employee['id'];?>">Realizado: </span><input id="<?php echo 'input_' .$employee['id'];?>" class="check form-input" type="checkbox" data-id="<?php echo 'td_' .$employee['id'];?>">
                        <p id="<?php echo 'p_' .$employee['id'];?>" class="visibility colorGreen"><i class="fas fa-check"></i><i class=" far fa-smile-beam"></i>       
                            <label for="radio2">Checked</label></p></div></td>
                    </tr>

                    <?php
                    }

                }
                
            }
            
        }
        ?>

    </tbody>
</table>

<!--FIN SECCIÓN LISTAR TAREAS -->


<!-- SECCIÓN HISTORIAL -->
<p class="centerElement" ><a id="historial" href="#">Historial |</a>
    <a href="http://localhost/Group_Manager/index.php?controller=message_controller&action=inbox"> Cerrar Historial</a><p>

<div id="tablaHistorial" class="visibility">
    <table id="tablaprueba" class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tarea</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
            </tr>
        </thead>
        
        <tbody>
            <?php listarTablaHistorial($mensajes)?>
        </tbody>
        
    </table>
</div>

<!--FIN SECCIÓN LISTAR TAREAS -->

<?php
//método que instancia un objeto message_ model y llama al método que guarda el contenido de la tbla mensajes y lo devuelve en un array
function getTableMessage() {

    $objMessage = new message_model(); //creo un objeto model_message
   

    return $mensajes= $objMessage->getMessages(); //accedo al método que devuelve el contenido de la tabla mensajes y lo guardo en el array 
}

function listarTablaHistorial($tablaMessages) {
    
    
    if (count($tablaMessages) > 0) {

        foreach ($tablaMessages as $employee) {


            //si el uasuario coincide con la sesión y si las tareas estas completadas se muestarn
            if ($employee['idUser'] == $_SESSION['id_user'] || $_SESSION['rol'] == 'admin') {

                if ($employee['completado'] === 'si') {
                   

                echo "<tr><td>".$employee['nameEmployee']."</td>";
                    
                echo "<td>".$employee['message']."</td>";
                
                echo "<td>".$employee['fechaInicio']."</td>";
                
                echo "<td>".$employee['fechaFin']."</td>
               
                </tr>";

                }
            }
        }        
    
}

}

//método que muestra en option del select los nombres de los empleados con tareas pendientes
function namesEmployeesTareas(){
    require_once 'controller/employee_controller.php';
    
    //objeto controller_employee
    $objEmployee = new employee_controller();
    
    $listaEmployees = $objEmployee->list();
    
    
    if (count($listaEmployees) > 0) {

            foreach ($listaEmployees as $employee) {
               
                //si el uasuario coincide con la sesión y si las tareas estas completadas se muestarn
                if ( $employee['idUser'] == $_SESSION['id_user'] || $_SESSION['rol'] == 'admin') {
     
                      echo '<option>'.$employee['nombre'].'</option>';  
                     
                }
                
                
            }
    }    
}
    


?>


<?php require_once 'template/footer.php'; ?>


