<?php

/* 
 * es el modelo principal. Contiene métodos que operan la información en la base de datos.
 */

class Employee {

	private $table = 'employees'; //nombre de la tabla de la bd
	private $conection;

	public function __construct() {
		
	}

	/* método que guarda en la propiedad $conection la conexión que devuelve el método de la clase Conection */
	public function getConection(){
		$dbObj = new ConectionDB(); //instancio objeto Conexión 
		$this->conection = $dbObj->conection();
	}

	/* método que devuelve un array que contiene todas las filas restantes del conjunto de resultados */
	public function getEmployees(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* recibe un id y devuelve el empleado asociado  */
	public function getEmployeeById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch(); //una fila de un conjunto de resultados asociado con un objeto PDOStatement
	}

	/* método que guarda un empleado en la base de datos. Comprueba si ya existe y lo actualiza y si
	no lo crea en la base de datos */
	public function save($param, $urlFoto){
		$this->getConection();

		/* Set default values */
		$nombre = $puesto = $email= $foto= "";

		/* Check if exists */
		$exists = false;
                
		if(isset($param["id"]) && $param["id"] !=''){ //si ya existe el empleado 
                    
			$actualEmployee = $this->getEmployeeById($param["id"]); 
			if(isset($actualEmployee["id"])){
				$exists = true;	
				/* Actual values */
				$id = $param["id"];
				$nombre = $actualEmployee["nombre"];
				$puesto = $actualEmployee["puesto"];
                                $email = $actualEmployee["email"];
                                $foto = $actualEmployee["foto"];//es la nueva ubicacion de la foto ya subida en el servidor 
			}
		}

                        /* Received values */
                if (isset($param["nombre"])) {
                    $nombre = $param["nombre"];
                }
                if (isset($param["puesto"])) {
                    $puesto = $param["puesto"];
                }
                if (isset($param["email"])) {
                    $email = $param["email"]; 
                }
                
                if(!empty($_FILES['archivo']['name'])){
                   $foto='img/'.$_FILES['archivo']['name'];
                }else{
                   $foto = $actualEmployee["foto"];
                }
                

        /* Database operations */
		if($exists){ //si existe se realiza la actualización
                    
			$sql = "UPDATE ".$this->table. " SET nombre=?, puesto=?, email=?, foto=? WHERE id=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$nombre, $puesto, $email, $foto, $id]);
                        
                        //si existe se cambia también el nombre en la tabla message 
                        $sql2 = "UPDATE mensajes SET nameEmployee=? WHERE idEmployee=?";
                        $stmt2 = $this->conection->prepare($sql2);
                        $res2 = $stmt2->execute([$nombre, $id]);
		}else{
			$sql = "INSERT INTO ".$this->table. " (nombre, puesto, idUser, email, foto) values(?, ?, ?, ?, ?)";
			$stmt = $this->conection->prepare($sql);
			$stmt->execute([$nombre, $puesto, $_SESSION['id_user'], $email, $foto]);
			$id = $this->conection->lastInsertId(); //asigna el id auto
		}	

		return $id;	

	}

	/* método que recibe la id de un empleado y elima a este y sus tareas pendientes de la base de datos */
	public function deleteEmployeeById($id){
		$this->getConection();
                
                //hay que eliminar los mensajes del empleado que se elimina
                $sql2 = "DELETE  FROM mensajes WHERE idEmployee = ?";
		$stmt2 = $this->conection->prepare($sql2);
		$stmt2->execute([$id]);
                
                
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
 
		return $stmt->execute([$id]);
	}
        
    

}