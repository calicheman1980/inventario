<?php

/**
 *
 **/

class Request{
    
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    
    public function __construct() {
        if(isset ($_GET['url'])){
            //genera un arreglo
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url);
            
            $this->_controlador = strtolower(array_shift($url));
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;
        }  
        
        if(!$this->_controlador){
            $this->_controlador = DEFAULT_CONTROLLER;
        }
        
        if(!$this->_metodo){
            $this->_metodo = 'index';            
        }
        
        if(!isset($this->_argumentos)){
            $this->_argumentos = array();
        }
    }
    //retorna el controlador
    public function getControlador(){
        return $this->_controlador;
    } 
    //retorna el metodo
    public function getMetodo(){
        return $this->_metodo;
    }
    //aqui nos hace un arreglo de argumentos
    public function getArgs(){
        return $this->_argumentos;
    }
    
}
?>
