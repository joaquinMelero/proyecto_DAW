<!DOCTYPE html>


<!-- abriremos las etiquetas necesarias de html, así como incrustaremos las llamadas a las librerías que vamos a utilizar -->
<html class="fondoGlobalInside">
    <head>
        <meta charset="utf-8">
        <title>Empleados Área 14 Granada</title>
        <link rel=stylesheet href="styles/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="operability/login.js"></script>
        <script src="operability/message.js"></script>
        <script src="operability/inbox.js"></script>
        <script src="operability/popup.js"></script>
        <script src="operability/newEmployee.js"></script>
        <script src="operability/empleado_sesion.js"></script>
        <script src="operability/export_csv.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class='fondoGlobalInside'>
        
        <nav id="menuHeader" class="nav">
            
            <?php
            if ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'empleado') {
                echo '<a class="nav-link active" href="http://localhost/Group_Manager/index.php?controller=employee_controller&action=edit">Crear Empleado</a>';
            }
            ?>
            <?php
            if ($_SESSION['rol'] != 'empleado') {
            echo "<a class='nav-link' href='http://localhost/Group_Manager/index.php?controller=employee_controller&action=list'>Listado de Empleados</a>";
            }
             ?>       
            <?php
            if ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'empleado' ) {
                echo ' <a class="nav-link" href="http://localhost/Group_Manager/index.php?controller=message_controller&action=inbox">Tareas de Departamento</a>';
            }
            ?>
           
            <a id="off"  class="nav-link" style="color: red" href="http://localhost/Group_Manager/index.php">Cerrar Sesión</a> 
            <p class="nav-link" style="color: yellowgreen"><?php if (isset($_SESSION['usuario'])) {
                    echo 'Sesión: ' . $_SESSION['usuario'] . " Dpto: ". $_SESSION['rol'] ;
                }
            ?>
            </p>
            
        </nav>
        
        <div class="container" style="text-align:center">
            <header id="header" class="headerPos lato">
                <h1 class="headerFont"><?php if ($_SESSION['rol'] != 'empleado') {
                echo $controller->page_title;
            } ?></h1>


            </header>