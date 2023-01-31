<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class indexController extends Controller{
    
    public function __construct() {
        parent::__construct();

    }
    
    public function index(){        
        $this->_view->titulo = 'Producto...!';
        $this->_view->renderizar('index', 'inicio');
    }

}
?>
