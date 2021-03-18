<?php

require_once 'securedController.php';
require_once 'model/userModel.php';

class UsersController extends SecuredController {


    public function __construct(){
        parent::__construct();
    } 

    /**
     * Obtengo todos los usuarios
     */
    public function users(){
        $this->response->users = $this->userModel->users();
        $this->returnData($this->response,200);
    }

    /**
     * Añadir usuario
     * valido que no exista un usuario con el mismo nombre de usuario
     */
    public function add(){

        $user = $_POST['user'];
        $password = $_POST['password'];

        $users = $this->userModel->users();
        
        $hago = true;
        foreach( $users as $dbUser) {
            if($user == $dbUser->user){
                $hago = false;
            }
        }

        if($hago){
            $response = $this->userModel->add($user,password_hash($password, PASSWORD_DEFAULT));
            $this->response->status = 'success';
            $status = 200;
        }
        else {
            $this->response->status = 'error';
            $status = 400;
        }

        $this->returnData($this->response,$status);
    }

    /**
     * Actualizar usuario
     */
    public function update($param = []){
        $this->userModel->update($param[':id'],$_POST['user'],password_hash($_POST['password'], PASSWORD_DEFAULT));
        $this->returnData($this->response,200);
    }

    /**
     * Eliminar usuario
     * Valido que el usuario a eliminar no sea el que posea sesion iniciada
     */
    public function delete($param = []){

        $status = $this->userModel->getUserToken($param[':id'],$this->getToken());
        if($status->total <= 0){
            $this->userModel->delete($param[':id']);
            $this->response->status = 'success';
            $status = 200;
        }
        else {
            $this->response->status = 'error';
            $status = 400;

        }

        $this->returnData($this->response,$status);
    }

    

    

}