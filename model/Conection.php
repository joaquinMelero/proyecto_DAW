<?php

class ConectionDB {

    //método estático para no crear instancia y acceder directamente a el
    //método para crear la conexión co la BD. Devuelve true si se ha establecido
    public static function conection() {

        //creo un try cath por si falla la conexión capturar la excepcion
        try {

            $conection = new PDO('mysql:host=localhost:3307; dbname=employees', 'dwes', 'melero'); //conexión pdo
            
        } catch (Exception $ex) {

            die("Error" . $ex->getMessage());

            echo "Linea error " . $ex->getLine();
        }

        return $conection; //devuelvo la conexión 
    }

}
