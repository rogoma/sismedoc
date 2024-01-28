<?php 
class Conexion{	  
    public static function Conectar() {        
        define('servidor', 'localhost');
        define('nombre_bd', 'db_hacdp');
        define('usuario', 'root');
        define('password', '');					        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);			
            return $conexion;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}

//PARA CONEXIÓN A PGSQL -->
// <?php 
// class Conexion{	  
//     public static function Conectar() {        
//         define('servidor', 'localhost');
//         define('nombre_bd', 'db_hacdp');
//         define('usuario', 'postgres');
//         define('password', 'postgres');					        
//         // $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');	
        
//         $opciones = [
//             PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//             PDO::ATTR_EMULATE_PREPARES   => false,            
//             PDO::PGSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'', // Configuración de codificación del cliente
//         ];

//         try{
//             $conexion = new PDO("pgsql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);			
//             return $conexion;
//         }catch (Exception $e){
//             die("El error de Conexión es: ". $e->getMessage());
//         }
//     }
// }