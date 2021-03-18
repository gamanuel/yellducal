<?php


class Controller {

    protected $response;

    public function __construct(){
        //Se define la variable response para utilizar en las respuestas fetch
        $this->response = new stdClass;
    }

    
    /**
     * Metodo que se encarga de formatear el json  y devolver un
     * status en la respuesta
     * @param object  $data
     * @param integer $httpCode
     */
    protected function returnData($data,$httpCode){
        print_r(json_encode($data));
        die();
    }


}