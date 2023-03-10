<?php

/**
 * Controlador principal
 * 
 **/

abstract class Controller{
    protected $_view;
    
    public function __construct() {
        $this->_view = new View(new Request);
    }

    abstract public function index();
    
    protected function loadModel($modelo){
        $modelo = $modelo. 'Model';
        $rutaModelo = ROOT. 'models'.DS.$modelo.'.php';
        
        if(is_readable($rutaModelo)){
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
            
        }
        else{
            throw new Exception('Error de modelo');
        }
           
    }
    
    protected function redireccionar($ruta = false)
    {
        echo $ruta;
        if($ruta){
            header('location:' . BASE_URL . $ruta);
            exit;
        }
        else{
            header('location:' . BASE_URL);
            exit;
        }
    }
    
    protected function getTexto($clave){
        
        if(isset($_POST[$clave]) && !empty ($_POST[$clave])){
            $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
            return $_POST[$clave];
        }
        return '';
    }
    
    protected function getDate($clave){
        
        if(isset($_POST[$clave]) && !empty ($_POST[$clave])){
            return $_POST[$clave];
        }
        return '';
    }

    //filtro para enteros enviados por url
    protected function filtrarInt($int)
    {
        $int = (int) $int;
        if(is_int($int)){
            return $int;
        }
        else{
            return 0;
        }
    }
    //filtra un entero enviado por post
    protected function getInt($clave){
         if(isset($_POST[$clave]) && !empty ($_POST[$clave])){
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
            return $_POST[$clave];
        }
        return 0;
        
    }
    //limpia los string de codigo sql sanitizar la contrasena por post
    protected function getSql($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = strip_tags($_POST[$clave]);
            
            if(!get_magic_quotes_gpc()){
                $_POST[$clave] = mysql_escape_string($_POST[$clave]);
            }
            
            return trim($_POST[$clave]);
        }
    }
    //Sanitizar el nombre de usuario por el metodo post
    protected function getAlphaNum($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
        
    }
}
?>
