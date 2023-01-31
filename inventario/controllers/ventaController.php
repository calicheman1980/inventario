<?php


class ventaController extends Controller{

    private $_ingreso;
    public function __construct() {
        parent::__construct();
        $this->_producto = $this->loadModel('producto');
        $this->_venta = $this->loadModel('venta');
    }

   public function index(){
      $this->_view->titulo = 'VENTAS';
      $this->_view->ventas = $this->_venta->getVentas();
      $this->_view->renderizar('index','venta');
   }

   public function venderProducto($id){
      $this->_view->titulo = 'VENTA';
      $this->_view->datos = $this->_producto->getProducto($id);

      if($this->getTexto('venderProducto') == 'VENDER'){
         $this->_view->datos = $_POST;
         if(!$this->getInt('cantidad')){
            $this->_view->datos = $this->_producto->getProducto($id);
            $this->_view->_error = 'Debe digitar una cantidad';
            $this->_view->renderizar('venderProducto', 'venta');
            exit;
         }
         if($this->getInt('cantidad') > $this->getInt('stock')){
            $this->_view->datos = $this->_producto->getProducto($id);
            $this->_view->_error = 'No se puede realizar la venta no hay stock suficiente';
            $this->_view->renderizar('venderProducto', 'venta');
            exit;
         }
         $this->_venta->insertarVenta(
               $this->getInt('id'),
               $this->getInt('cantidad'),
               $this->getInt('precio')
            );
         $saldoStock = $this->getInt('stock') - $this->getInt('cantidad');
         $this->_venta->actualizaStock(
            $this->getInt('id'),
            $saldoStock
         );
         $this->redireccionar('venta');

      }
      $this->_view->renderizar('venderProducto','venta');
   }

   public function consultaUno(){
      $this->_view->titulo = 'CONSULTA UNO';
      $this->_view->producto = $this->_producto->getProductoStock();
      $this->_view->renderizar('consultaUno','venta');
   }

   public function consultaDos(){
      $this->_view->titulo = 'CONSULTA DOS';
      $this->_view->ventas = $this->_venta->getVentasProducto();
      $this->_view->renderizar('consultaDos','venta');
   }
}