<?php

/*
 * En este archivo se controla el producto
 * 
 * 
 */

class productoController extends Controller{
    
    private $_producto;
    public function __construct() {
        parent::__construct();
        $this->_producto = $this->loadModel('producto');
    }

    public function index(){
        $this->_view->categoria = $this->_producto->getCategorias();
        $this->_view->productos = $this->_producto->getProductosActivos(0);
        $this->_view->titulo = 'PRODUCTOS';
        $this->_view->renderizar('index', 'producto');

    }

    public function nuevoProducto(){
        $this->_view->categoria = $this->_producto->getCategorias();
        $this->_view->titulo = 'NUEVO PRODUCTO';
        if($this->getTexto('regProducto') == 'REGISTRAR'){
            $this->_view->datos = $_POST;

            if(!$this->getTexto('nombre')){
                $this->_view->_error = 'Debe introducir un nombre';
                $this->_view->renderizar('nuevoProducto', 'producto');
                exit;
            }
            if(!$this->getTexto('referencia')){
                $this->_view->_error = 'Debe introducir una referencia';
                $this->_view->renderizar('nuevoProducto', 'producto');
                exit;
            }
            if(!$this->getInt('peso')){
                $this->_view->_error = 'Debe introducir un peso';
                $this->_view->renderizar('nuevoProducto', 'producto');
                exit;
            }
            if(!$this->getInt('categoria')){
                $this->_view->_error = 'Debe seleccionar una categoria';
                $this->_view->renderizar('nuevoProducto', 'producto');
                exit;
            }

            if(!$this->getInt('precio')){
                $this->_view->_error = 'Debe digitar un precio';
                $this->_view->renderizar('nuevoProducto', 'producto');
                exit;
            }

            if(!$this->getInt('stock')){
                $this->_view->_error = 'Debe digitar un stock';
                $this->_view->renderizar('nuevoProducto', 'producto');
                exit;
            }

            $this->_producto->insertarProducto(
                $this->getTexto('nombre'),
                $this->getTexto('referencia'),
                $this->getInt('precio'),
                $this->getInt('peso'),
                $this->getInt('categoria'),
                $this->getInt('stock'),
                $this->getTexto($ahora)
            );
            $this->redireccionar('producto');
        }

        $this->_view->renderizar('nuevoProducto','producto');
    }

    public function nuevaCategoria($id=''){
        $this->_view->titulo = 'NUEVA CATEGORIA';
        $this->_view->categoria = $this->_producto->getCategorias();
        if(($id=='' && (isset($_POST['id']) && $_POST['id']=='')) && $this->getTexto('regCategoria') == 'GUARDAR'){
            # Agregamos nuevo
            $this->_view->datos = $_POST;
            if(!$this->getTexto('nombre')){
                $this->_view->_error = 'Debe introducir un nombre';
                $this->_view->renderizar('nuevaCategoria', 'producto');
                exit;
            }
            $this->_producto->insertarCategoria(
                $this->getTexto('nombre')
            );
            $this->redireccionar('producto/nuevaCategoria');
        }else{
            if((isset($_POST['id']) && $_POST['id']!='') && $this->getTexto('regCategoria') == 'GUARDAR'){
                $this->_producto->actualizaCategoria(
                    $this->getInt('id'),
                    $this->getTexto('nombre')
                );
                $this->redireccionar('producto/nuevaCategoria');
            }
            $this->_view->datos = $this->_producto->getCategoria($id);
        }
        $this->_view->renderizar('nuevaCategoria','producto');
    }

    public function modificarProducto($id){
        $this->_view->titulo = 'MODIFICAR PRODUCTO';
        $this->_view->datos = $this->_producto->getProducto($id);
        $this->_view->categoria = $this->_producto->getCategorias();
        if($this->getTexto('regProducto') == 'GUARDAR'){
            $this->_view->datos = $_POST;
            if(!$this->getTexto('nombre')){
                $this->_view->_error = 'Debe introducir un nombre';
                $this->_view->renderizar('modificarProducto', 'producto');
                exit;
            }
            if(!$this->getTexto('referencia')){
                $this->_view->_error = 'Debe introducir una referencia';
                $this->_view->renderizar('modificarProducto', 'producto');
                exit;
            }
            if(!$this->getInt('peso')){
                $this->_view->_error = 'Debe introducir un peso';
                $this->_view->renderizar('modificarProducto', 'producto');
                exit;
            }
            if(!$this->getInt('categoria')){
                $this->_view->_error = 'Debe seleccionar una categoria';
                $this->_view->renderizar('modificarProducto', 'producto');
                exit;
            }
            $stock = $this->getInt('stock')+$this->getInt('oldstock');
            $this->_producto->actualizaProducto(
                $this->getInt('id'),
                $this->getTexto('nombre'),
                $this->getTexto('referencia'),
                $this->getInt('peso'),
                $stock,
                $this->getInt('categoria'),
                $this->getInt('estado')
            );
            $this->redireccionar('producto');
        }
        $this->_view->renderizar('modificarProducto','producto');
    }
}

?>
