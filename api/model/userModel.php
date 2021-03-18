<?php

require_once 'model.php';

class UserModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function users(){
      
        $sentencia = $this->conectarBaseDeDatos->prepare("SELECT id, user FROM usuarios");
        $sentencia->execute(array());
          
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function userAuth($user){
      
        $sentencia = $this->conectarBaseDeDatos->prepare("SELECT * FROM usuarios WHERE user = ? ");
        $sentencia->execute(array($user));
          
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function add($user,$password){
      
        $sentencia = $this->conectarBaseDeDatos->prepare("INSERT INTO usuarios (user,password) VALUES(?,?)");
        $sentencia->execute(array($user,$password));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function delete($userId){
      
        $sentencia = $this->conectarBaseDeDatos->prepare("DELETE FROM usuarios WHERE id = ?");
        $sentencia->execute(array($userId));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function update($userId,$user,$password){
      
        $sentencia = $this->conectarBaseDeDatos->prepare("UPDATE usuarios SET user = ? , password = ? WHERE id = ?" );
        $sentencia->execute(array($user,$password,$userId));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function saveToken($token,$userId){
      
        $sentencia = $this->conectarBaseDeDatos->prepare("UPDATE usuarios SET access_token = ? WHERE id = ?");
        $sentencia->execute(array($token,$userId));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function getToken($token){
      
        $sentencia = $this->conectarBaseDeDatos->prepare("SELECT COUNT(*) as total FROM usuarios WHERE access_token = ? AND access_token IS NOT NULL");
        $sentencia->execute(array($token));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function getUserToken($userId,$token){
      
        $sentencia = $this->conectarBaseDeDatos->prepare("SELECT COUNT(*) as total FROM usuarios WHERE id = ? AND access_token = ? ");
        $sentencia->execute(array($userId,$token));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }




}
