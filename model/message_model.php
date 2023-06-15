<?php

/* 
 * Clase para operar con la base de datos y tabla mensajes 
 */

class message_model {

    private $table = 'mensajes'; //nombre de la tabla de la bd
    private $conection;

    public function __construct() {
        
    }

    public function getConection() {
        $dbObj = new ConectionDB(); //instancio objeto Conexión 
        $this->conection = $dbObj->conection();
    }

    //método para guardar en la tabla mensajes el campo texto introducido por el usuario 
    public function addMessage($message, $nameEmployee, $idEmployee) {

        $this->getConection();

 

        //Escribimos la consulta necesaria
        $sql = "INSERT INTO " . $this->table . "(id, message, idUser, nameEmployee, completado, idEmployee) values(?, ?, ?, ?, ?, ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([null, $message, $_SESSION['id_user'], $nameEmployee , 'no', $idEmployee] );

    }
    
    /* Get all messages */
    public function getMessages() {
        $this->getConection();

        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    
    
     /* Delete message by id */
	public function completeMessageById($id){
		$this->getConection();
                $fechaActual = date("Y-m-d H:i:s");
		$sql = "UPDATE ".$this->table. " SET completado='si', fechaFin='".$fechaActual."' WHERE id =?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
               
	}
    
    /* Delete message by id */
	public function deleteMessageById($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
	}
 
        
     //método que recibe una id-user y nombre empleado y devuelve la foto de su tabla
    public function getFoto($id, $name) {
        
        $this->getConection();
        $sql = "SELECT foto FROM employees WHERE idUser = ? AND nombre = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$id, $name]);
        return $stmt->fetchAll();
        
    }
    
    //método que recibe un nombre empleado y devuelve sus tareas
    public function functionTareasName($name) {
        $this->getConection();
        $sql = "SELECT message FROM mensajes WHERE nameEmployee =? AND completado='no'";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$name]);
        return $stmt->fetchAll();
        
    }

}
