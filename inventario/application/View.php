<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class View{
    
    private $_controlador;
    private $_js;
    
    public function __construct(Request $peticion) {
        $this->_controlador = $peticion->getControlador();
        $this->_js = array();
    }
    
    public function renderizar_vista($vista, $item = false){
        
        $rutaView = ROOT. 'views'. DS. $this->_controlador . DS . $vista.'.phtml';
        if(is_readable($rutaView)){             
            include_once $rutaView;
            
         }else{
            
             throw new Exception('Error de Vista');
         }
    }
    
    public function renderizar($vista, $item = false){
        $menu[] = array(
                    'id'=>'producto',
                    'titulo'=>'productos y ventas',
                    'enlace'=>BASE_URL.'producto'
                );
         $menu[] = array(
                    'id'=>'ingreso',
                    'titulo'=>'Ventas',
                    'enlace'=>BASE_URL.'venta'
                );

        $menu[] = array(
                    'id'=>'ingreso',
                    'titulo'=>'consulta 1',
                    'enlace'=>BASE_URL.'venta/consultaUno'
                );

        $menu[] = array(
                    'id'=>'ingreso',
                    'titulo'=>'consulta 2',
                    'enlace'=>BASE_URL.'venta/consultaDos'
                );
        
        $js = array();
        
        if(count($this->_js)){
            $js = $this->_js;
        }
        
        $_layoutParams = array(
            'ruta_css' => BASE_URL.'views/layout/'. DEFAULT_LAYOUT.'/css/',
            'ruta_js' => BASE_URL.'views/layout/'. DEFAULT_LAYOUT.'/js/',
            'ruta_img' => BASE_URL.'views/layout/'. DEFAULT_LAYOUT.'/img/',
            'menu'=>$menu, 
            'js' => $js
        );
        
        $rutaView = ROOT. 'views'. DS. $this->_controlador . DS . $vista.'.phtml';
        if(is_readable($rutaView)){
           include_once ROOT.'views'.DS.'layout'.DS.DEFAULT_LAYOUT.DS.'header.php';
           include_once $rutaView;
           include_once ROOT.'views'.DS.'layout'.DS.DEFAULT_LAYOUT.DS.'footer.php';
            
        }
        else{
            throw new Exception('Error de Vista');
        }
    }
    
    public function setJs(array $js){
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_js[] = BASE_URL. 'views/'. $this->_controlador.'/js/'.$js[$i]. '.js';
            }
        }else{
            throw new Exception('Error de js');
        }
    }
    
}
?>
