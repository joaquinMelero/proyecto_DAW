<?php

/* 
 * controlador que interacciona con el modelo login y la vista de login. Recibe los datos desde la vista login por ajax 
 * se llama al método que comprueba que los datos recibidos por el form y bd coinciden, se inica sesión
 */

require_once 'model/login_model.php';

class login_controller {

    public $view; // atributo para guardar la vista 
    public $loginObj; //atributo para guardar el objeto Login
    public $page_title;

    public function __construct() {

        $this->view = 'index_login'; //
        $this->loginObj = new login_model(); // objeto login para aceder a los métodos 
    }
    
      
    public function login(){
        $this->page_title = 'Login'; //cargar la vista 
    }
    
    
    //función que comprueba las credenciales recibidas por ajax con las de la BD
    public function checkAcces() {
    
        
        if (isset($_POST['user']) && !empty($_POST['user'])) { //si el usuario esixte y no está vacío 
            
            $accesDB = $this->loginObj->getUserPassDB($_POST['user']); // llamo al métdo del mpdelo que devuelve el array de las credenciales
            

            $userBD = $accesDB[0];
            $passBD = $accesDB[1];
            $rol = $accesDB[2];
            $id_user = $accesDB[3];
            

            if ($userBD === $_POST['user'] && $passBD === md5($_POST['pass'])) { //si coinciden las guardo en las sesiones

                $_SESSION['usuario'] = $userBD;
                $_SESSION['estado'] = "Autenticado";
                $_SESSION['rol'] = $rol;
                $_SESSION['id_user'] = $id_user;
                
                
                 echo $_SESSION['usuario']. " ".$_SESSION['estado']; return;
                
            }
        }
    }
    
    //método que borra las sesiones y devuelve al login o index 
    public function logOff () {
       
        session_destroy();
        
    }
    
    
    //método para mostrar el formulario y mandar los datos del registro al modelo donde los introduce en la tabla 
    public function addRegister() {
        
        if (isset($_POST['newName']) && !empty($_POST['newName'])){

            
           $this->loginObj->addUser($_POST['newName'], $_POST['newUser'], md5($_POST['newPass']), $_POST['select']); // llamo al métdo del mpdelo que devuelve que introduce el nuevo registro en bd
            
        }   
    }
    
    //recibe un id de usuario, llama al método del modelo y devuelve el rol de ese usuario 
    public function getRolEmployee($idUser) {
        
         $rol= $this->loginObj->getRol($idUser);
         
         return $rol;
        
    }

}
