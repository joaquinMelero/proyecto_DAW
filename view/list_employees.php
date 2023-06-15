<!-- Es la vista que se encarga de mostrarnos los empleados ya creados, si los hay. 
Además tiene un botón para crear un empleado nuevo -->



<?php require_once 'template/header.php'; ?>

<div class="row fondoRowCard">

    <?php
    if ($_SESSION['rol'] == 'empleado') {
        echo '<h1 style="margin-top:-14%";>VISTA DE EMPLEADO<h1>';
    }
    
    //incluyo el archivo para crear un objeto y acceder al método de cont tareas
      require_once 'controller/message_controller.php';
      
      $objMessage = new message_controller();
      
      
    //listar en cards los empleados que hay en la tabla granada 
    if (count($dataToView["data"]) > 0) {
        
        foreach ($dataToView["data"] as $employee) {
            
            
            if($employee['idUser']== $_SESSION['id_user'] || $_SESSION['rol']== 'admin'){ //si los empleados coinciden con el mismo departamento se mostrarán 
                
               
            
            ?>
            <div id="<?php echo $employee['id']; ?>" class="col-md-3 " style="margin-bottom: 2em">
                <div class="card-body border border-secondary rounded fondoCard lato">
                    <h2 id="<?php echo $employee['nombre'];?>" class="card-title colorOrange"><?php echo $employee['nombre'] ?></h2>
                    <h4 id="rol" class="card-title colorOrange" style="color:rgb(1, 58, 99)" ><?php 
                    
                    require_once 'controller/login_controller.php';
                    $objLogin = new login_controller();
                    echo 'Dpto: '.$objLogin->getRolEmployee($employee['idUser']);
                    
                    ?></h4>
                    <div class="card-text colorOrange"><h4>Puesto: <?php echo nl2br($employee['puesto']); ?></h4></div>
                    <hr class="mt-1"/>

                    <?php
                    if ($_SESSION['rol'] == 'admin') {

                        echo'<a href="index.php?controller=employee_controller&action=edit&id=' . $employee['id'] . '"';
                        echo" class='btn button1 btn-filtrar2 ' style='color:teal; margin-bottom:1%;'>Editar</a>";

                        echo ' <a id="borrar" class="borrar btn button1 btn-filtrar2 " style="color:red"; data-set="' . $employee["id"] . '">Eliminar</a>';
                    }
                    
                     if ($_SESSION['rol'] != 'admin') {
                    ?>
        
                   <i id="<?php echo $employee['id']; ?>" class="colorBrown far fa-edit" ></i>
                   <i id="<?php echo 'ficha_'.$employee['id']; ?>" data-id="<?php echo $employee['id']; ?>" class="ficha far fa-user"></i>
                   <i class="listaTarea fa fa-list" aria-hidden="true"></i><span id="tareaPentienteEmployeeCont" class="numTareas"><?php $objMessage->contTareasEmployee($employee['nombre']); ?></span>

                    <div id="<?php echo 'textMessage_' .$employee['id']; ?>" class="form-group green-border-focus visibility">
                        <label >Introduce la tarea: </label>
                        <textarea class="form-control " id="<?php echo 'textArea_' .$employee['id']; ?>" rows="3" style="margin-bottom:2%;"></textarea>
                        <button id="sendMessage" data-id="<?php echo $employee['id']; ?>" data-name="<?php echo $employee['nombre'];?>" type="button" class="enviar button1 btn-filtrar2 " style="color:teal ";>Enviar</button>
                        <button type="button" class="cerrar button1 btn-filtrar2 " style="color:teal ">Cerrar</button>
                    </div>
                   
                     <?php } ?>
                </div>
            </div>


            <?php
                     
        }
        
       }  
    } else {
        ?>
        <div class="alert alert-info">
            Actualmente no existen Empleados.
        </div>
        <?php
    }
    ?>



</div>

<!-- ventana del popup al pulsar en la ficha del empleado -->
<div id="popup" class="popup">

    <!-- imagen de empleado -->
    <img  id="fotoEmployee" src="" width="420" alt="popup">

    <!-- Información del empleado y botón cerrar popup-->
    <div class="colorOrange" style="padding:1em;">
        
        <fieldset>
            <h3 style="color:teal">Ficha Personal</h3>
            
            <span style="padding-bottom: 22em;">__________</span>
            
            <h4 id="nombreEmpleado"></h4>
            <h6 id="departEmpleado"></h6>
            <p id="emailEmpleado"></p>
        </fieldset>
        <br>
        <button id="closePop" class="btn btn-ficha">Cerrar Ficha</button>
        
    </div>
        <br>
</div>


<!-- SECCIÓN QUE VE EL USUARIO EMPLEADO -->
<?php


if ($_SESSION['rol'] == 'empleado') {


    echo "<div id='divFiltro' class='colorWhite'><p>Selecciona empleado para ver sus tareas pendientes: 
    <select  id='nameEmpl'>
        <option selected='true' disabled='disabled'>
            seleccione un empleado
        </option>";
    
//método que muestra las opciones del select
   namesEmployeesTareas();
    
    
    echo "</select>
          <button id='btnRes' class='btn-filtrar2 button1'style='margin-top:2%'><a href='http://localhost/Group_Manager/index.php'>Reset</a>
          </button>
        </p></div>";
    
    
    echo "<div id='listaTareas' class='container colorWhite'></div>";
        
}
?>                    

<!--FIN SECCIÓN QUE VE EL USUARIO EMPLEADO -->



<?php require_once 'template/footer.php'; ?>


<?php 
     //método que muestra en option del select los nombres de los empleados con tareas pendientes
    function namesEmployeesTareas() {
        require_once 'controller/employee_controller.php';

        //objeto controller_employee
        $objEmployee = new employee_controller();

        $listaEmployees = $objEmployee->list();

        if (count($listaEmployees) > 0) {

            foreach ($listaEmployees as $employee) {


                echo '<option>' . $employee['nombre'] . '</option>';
            }
        }
    }
?>
