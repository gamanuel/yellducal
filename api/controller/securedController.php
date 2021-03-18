<?php

require_once 'controller.php';

class SecuredController extends Controller {

  protected $userModel;

  public function __construct(){
    parent::__construct();
    $this->userModel = new UserModel();
    $this->getToken();
  } 


  protected function  getToken(){
    $headers = apache_request_headers();
    if(isset($headers['authorization'])){
        if(strpos($headers['authorization'], 'Bearer') !== false){
            $token = str_replace('Bearer ','',$headers['authorization']);
            $response = $this->userModel->getToken($token);

            if($response->total <= 0){
              throw new Exception("Token invalido.");
            }

            return $token;
        }
        else {
            http_response_code(401);
            throw new Exception("Token invalido.");
        }
    }    
    else {
        http_response_code(401);
        throw new Exception("Token invalido.");
    }     
  }

}