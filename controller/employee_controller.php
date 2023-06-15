<?php

/* 
 *  Se encarga de recibir las peticiones desde la vista, solicitar información y/u ordenar cambios al modelo.
 */

require_once 'model/employee_model.php';

class employee_controller{
    
	public $page_title; //atributo para guardar el título de la acción (dinámico)
	public $view; // atributo para guardar la vista 
        public $employeeObj; //atributo para guardar el objeto Empleado

	public function __construct() {
		$this->view = 'list_employees'; //vista de los trabajadores 
		$this->page_title = '';
		$this->employeeObj = new Employee();
	}

	/* List todos los empleados */
	public function list(){
		$this->page_title = 'Listado de Empleados';
		return $this->employeeObj->getEmployees();
	}
        

	/* recibe un id desconocido */
    public function edit($id = null) {
        $this->page_title = 'Crear Empleado';
        $this->view = 'edit_employee';
        //copruebo por el método get si existe l parámetro id 
        if (isset($_GET["id"])) {
            $this->page_title = 'Editar Empleado';
            $id = $_GET["id"];
        }
        return $this->employeeObj->getEmployeeById($id);
    }

    /* Método para crear o actualizar registro */
    public function save() {

        $fotoEmployee = upImg();//método para subir la foto 
        $this->view = 'edit_employee';
        $this->page_title = 'Editar Empleado';
        $id = $this->employeeObj->save($_POST,$fotoEmployee);
        $result = $this->employeeObj->getEmployeeById($id);
        $_GET["response"] = true; //al guardarse el nuevo empleado editado creo e inicializo la variable a true 
        return $result;
    }

    /* Confirm to delete */
	public function confirmDelete(){
		$this->page_title = 'Eliminar Empleado';
		$this->view = 'confirm_delete_employee';
		return $this->employeeObj->getEmployeeById($_GET["id"]); 
	}

	/* Delete */
	public function delete(){
		$this->page_title = 'Listado de Empleados';
		$this->view = 'delete_employee';
		return $this->employeeObj->deleteEmployeeById($_POST["id"]); ///recibe el $_POST["id"] de la view confirm_delete
	}
        
        
        /* Delete  javascript*/
	public function deletejs(){
		$this->page_title = 'Listado de Empleados';
		return $this->employeeObj->deleteEmployeeById($_POST["variable"]); ///recibe el $_POST["id"] de la view confirm_delete
                 header('Location: http://localhost/Group_Manager/index.php');
	}
        
        //métdo para obtener los datos de un trabjador
        public function getFicha() {
            
            //tengo que poner aquí los datos que quiero añadir a la ficha
             $ficha= $this->employeeObj->getEmployeeById($_POST["idEmployee"]);
             
             echo $ficha['nombre'].",";
             echo $ficha['puesto'].",";
             echo $ficha['email'].","; 
             echo $ficha['foto'].","; 
             
        }
        
        //método que comprueba si esixte en la bd un nombre ya registrado.
        //devuelve false o true
        public function checkNameEmployee() {
            
            $exist = false;
            
           $listaEmpleados = $this->employeeObj->getEmployees();
            
            foreach ($listaEmpleados as $value) {
                
                if(trim($_POST["valName"])==trim($value['nombre'])){
                    
                    $exist=true;
                    
                }
                
            }
            
         echo $exist;
 
        }
 
}

 //método para comprobar la imagen que el usuario sube y guardarla en
//carpeta del proyecto
function upImg() {
    

    //Si se quiere subir una imagen
    if (isset($_POST['subir'])) {
        //Recogemos el archivo enviado por el formulario
        $archivo = $_FILES['archivo']['name'];
        $temp = $_FILES['archivo']['tmp_name'];
        
        //Se intenta subir al servidor
        $fotoEmployee = 'img/' . $archivo;
                
        move_uploaded_file($temp, 'img/' . $archivo);   
        
    }
    
    return $fotoEmployee;
}
