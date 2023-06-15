<?php

/* 
 * En este fichero se encarga de la información básica 
 * del controlador y la acción por defecto.
 * También se controla el acceso de a la app por defecto si se ha iniciado sesión
 */

/* Default options */

if(isset($_SESSION['estado']) && $_SESSION['estado'] == "Autenticado"){ //si existe la sesion y es ok 
  
     define("DEFAULT_CONTROLLER", "employee_controller");
     define("DEFAULT_ACTION", "list");
}else{
    
    define("DEFAULT_CONTROLLER", "login_controller");
    define("DEFAULT_ACTION", "login");
    
}

