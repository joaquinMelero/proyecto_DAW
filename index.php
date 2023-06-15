<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php

/* 
 * En este fichero recibiremos todas las peticiones, tanto para el controlador de employee como para otros si los hubiere.
 */


//Iniciamos la sesión
session_start();


require_once 'config/config.php';
require_once 'model/Conection.php';


if (isset($_GET['controller'])) { //si existe un controlador que se ha inyectado por url 
    $controllerPath = 'controller/' . $_GET['controller'] . '.php'; //la url 

    require_once $controllerPath;

    $controller = new $_GET['controller']; //se crea un objeto controlador con el nombre guardado

    $dataToView["data"] = array();
    if (method_exists($controller, $_GET['action'])) {

        $dataToView["data"] = $controller->{$_GET["action"]}();

        require_once 'view/' . $controller->view . '.php';
    }
} else {//si no entra el nombre controlador por url cargo los default de config 
    $controllerPath = 'controller/' . constant("DEFAULT_CONTROLLER") . '.php';

    require_once $controllerPath;

    $classController = DEFAULT_CONTROLLER;

    $controller = new $classController;

    $dataToView["data"] = array();//array para guardar la información del controller
    
    if (method_exists($controller, constant("DEFAULT_ACTION"))) {

        $dataToView["data"] = $controller->{constant("DEFAULT_ACTION")}();

        require_once 'view/' . $controller->view . '.php';
    }
}
?>