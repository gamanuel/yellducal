<?php
include_once "model/modelDatos.php";
define('HOST',$db_host);
define('BASE',$db_base);
define('USER',$db_user);
define('PASS',$db_pass);

class Model {

  protected $conectarBaseDeDatos;

  public function __construct(){
    try {
      $this->conectarBaseDeDatos = new PDO('mysql:host='.HOST.';dbname='.BASE.';charset=utf8',USER,PASS); 
      // no hubo error      
    } 
    catch (PDOException $e) {
      //crear base de datos
      $this->crearDB();      
    } 
    catch (Exception $e) {
      echo "error";
      print "¡Error!: " . $e->getMessage() . "<br/>";
    }       
  }  

  function crearDB(){
      
    //crear la base de datos - conexion a mysql
    $this->conectarBaseDeDatos = new PDO('mysql:host='.HOST.';dbname=mysql;charset=utf8',USER,PASS); 
    $sentencia = $this->conectarBaseDeDatos->prepare("CREATE DATABASE ".BASE." /*!40100 COLLATE 'latin1_swedish_ci' */;");
    $sentencia->execute();
    //conexion a nueva Base
    try {
      $this->conectarBaseDeDatos = new PDO('mysql:host='.HOST.';dbname='.BASE.';charset=utf8',USER,PASS); 
      // no hubo error
      // recorrer archivo sql para generar las tablas y contenidos
      $myfile = fopen("model/".BASE.".sql", "r") or die("Error al abrir el archivo!");
      $la_consulta = "";
      while ($line = fgets($myfile)) {
        $posicion = strpos($line,"-- ");
        if($posicion === false){
          $la_consulta .= $line;
          if(strpos($line,";")>0){
            $sentencia = $this->conectarBaseDeDatos->prepare($la_consulta);
            $sentencia->execute();
            $la_consulta = "";    
          }
        }
      }
      
    } 
    catch (PDOException $e) {
      //crear base de datos
      echo "error base nueva";      
    } 
    catch (Exception $e) {
      echo "error";
      print "¡Error!: " . $e->getMessage() . "<br/>";
    }
  
    fclose($myfile);
  }
}         