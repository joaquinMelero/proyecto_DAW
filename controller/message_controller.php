<?php

/*
 * Clase para controlar/relacionar la vista del usuario de enviar mensajes y la base de datos donde se guardarán 
 */

require_once 'model/message_model.php';

class message_controller {

    public $view; // atributo para guardar la vista 
    public $messageObj; //atributo para guardar el objeto Message_model
    public $page_title; //atributo para guardar el título de la acción (dinámico)

    public function __construct() {
        
        $this->view = 'inbox_employee'; //vista de los trabajadores 
        $this->messageObj = new message_model(); // objeto login para aceder a los métodos 
    }
    
    
    /* Lista de mensajes o tareas */
	public function inbox(){
		$this->page_title = 'Dpto. de '.$_SESSION['rol'] .': Daily To Do Lists ';
	}
    
    //método que recibe del message.js los campos a registrar en la tabla mensajes 
    public function saveMessage() { 
        
        if (isset($_POST['idEmployee']) && !empty($_POST['idEmployee'])) { //si el id esixte y no está vacío 
            
            $this->messageObj->addMessage($_POST['message'], $_POST['nombreEmpleado'], $_POST['idEmployee']);
            
        }
            
    }
    
    
     /* Método que manda al modelo la id de un mensaje para poner la tarea realizada */
	public function completeMessage(){
		
            $this->messageObj->completeMessageById($_POST['idMessage']); ///recibe el $_POST["id"] de la view confirm_delete
                 
	}
    
    /* Le pasa la id al método del modelo para barrar este mensaje en la base de datos */
	public function deleteMessage(){
		
            $this->messageObj->deleteMessageById($_POST['idMessage']); ///recibe el $_POST["id"] de la view confirm_delete
                 
	}
        
        
    //método que llama el modelo para obtener la foto de un id y su nombre
    public function getFoto($id, $name) {
    
        return $this->messageObj->getFoto($id, $name);
    }
    
    
    //método que recibe idUser de un empleado y devuelve el número de tareas que tiene pendiente
    public function contTareasEmployee($nameEmployee) {
        
        $cont = 0; //contador de tareas

        $mensajes = $this->messageObj->getMessages(); //accedo al método que devuelve el contenido de la tabla mensajes y lo guardo en el array 
        
        //nencesito la tabla de mesnajes para consultar por nombre y ponerle el número

        if (count($mensajes) > 0) {

            //recorro todos los registros de la tabla
            foreach ($mensajes as $employee) {
                
                //si el nombre del paŕametro esta en un registro cont++, la tarea esta pendiente
                // y el idUser coincide con la sesión activa
                if($employee['nameEmployee']==$nameEmployee && $employee['completado']=='no'
                        && $employee['idUser'] == $_SESSION['id_user'] ){
                    
                    $cont++;
                }
                
            }
        }
        
        echo $cont;
    }
    
    //método que recibe el nombre de un empleado por ajax y devuelve el listado de tareas  
    public function listarTareasEmpleado() {
    
       $tareas =  $this->messageObj->functionTareasName($_POST['empleadoSelec']);            
       
       for($i=0; $i<count($tareas); $i++){
           
           echo $tareas[$i]['message'].'|¬'; //los carácteres son para separar las tareas
       }
       
    }

}
