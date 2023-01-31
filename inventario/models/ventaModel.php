<?php

class ventaModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function insertarVenta($idProducto, $cantidad, $precio){
        $this->_db->prepare("INSERT INTO venta VALUES (NULL, :idProducto, :cantidad, :valorUnitario, :valor)")
            ->execute(
            array(
                ':idProducto'=>$idProducto,
                ':cantidad'=>$cantidad,
                ':valorUnitario'=>$precio,
                ':valor'=>$cantidad*$precio
            ));
    }

    public function actualizaStock($idProducto,  $stock){
        $this->_db->prepare("UPDATE productos SET  stock = :stock WHERE id = :id")
                    ->execute(array(
                            ':stock'=> $stock,
                            ':id'=>$idProducto
                    ));
    }

    public function getVentas(){
        $ventas = $this->_db->query("SELECT V.id, P.nombre, C.nombre AS categoria, V.cantidad, V.valorUnitario, V.valor   from venta V
            INNER JOIN productos P ON P.id=V.idProducto
            INNER JOIN categoria C ON C.id = P.idCategoria

            ");
        return $ventas->fetchAll();
    }

    public function getVentasProducto(){
        $ventas = $this->_db->query("SELECT V.id, P.nombre, P.referencia, P.precio, C.nombre AS categoria, SUM(V.cantidad) AS cantidad, V.valorUnitario, SUM(V.valor) AS total  from venta V
            INNER JOIN productos P ON P.id=V.idProducto
            INNER JOIN categoria C ON C.id = P.idCategoria
            GROUP BY V.idProducto
            ORDER BY total DESC");
        return $ventas->fetch();
    }
}