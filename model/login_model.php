<?php

/*
 * Clase para guardar los datos de usuario de la tabla de la bd
 */

/**
 *
 * @author Joaquín
 */
class login_model {
    
    private $table = 'users'; //nombre de la tabla de la bd
    private $conection;
    
    public function __construct() {
        
    }
    
    
     public function getConection(){
        $dbObj = new ConectionDB(); //instancio objeto Conexión 
        $this->conection = $dbObj->conection();
    }

    //función que comprueba en la tabla user si los usuarios están y los devuelve 
    public function getUserPassDB($username) {
        
        $this->getConection();

        try {

            //Escribimos la consulta necesaria
            $sql = "SELECT * FROM " . $this->table . " WHERE username='" . $username . "'";

            //obtengo los resultados
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();

            $datos = $stmt->fetch(PDO::FETCH_ASSOC); //guardo el resultado en una fila 
            //Guardamos los resultados del nombre de usuario 
            //y de la contraseña de la base de datos
            $userBD = $datos['username'];
            $passwordBD = $datos['pass'];
            $rol = $datos['rol'];
            $id_user = $datos['id_user'];

            return $dataAcces = [$userBD, $passwordBD,$rol,$id_user];
            
        } catch (Exception $ex) {
            die('Los datos de acceso no están en la BD');
        }
    }
    
    public function addUser($names, $username, $pass, $rol) {

        $this->getConection();

        //Escribimos la consulta necesaria
        $sql = "INSERT INTO " . $this->table . " (id_user, names, username, pass, rol) values(?, ?, ?, ?, ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([null,$names, $username, $pass, $rol]); //falta el id por eso da el error
       
        
    }
    
    public function getRol($idUser) {
        
        $this->getConection();
        
         //Escribimos la consulta necesaria
            $sql = "SELECT rol FROM " . $this->table . " WHERE id_user='" . $idUser . "'";

            //obtengo los resultados
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC); //guardo el resultado en una fila 
            return $rol = $data['rol'];
             
    }

}
