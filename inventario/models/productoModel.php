<?php

/*
 *
 */

class productoModel extends Model{
    
    public function __construct() {
        parent::__construct();
    }


    public function getCategorias(){
        $categoria = $this->_db->query("SELECT id, nombre from categoria");
        return $categoria->fetchAll();
    }

    public function getCategoria($id){
        # Consulta una categoria
        $id = (int) $id;
        $categoria = $this->_db->query('SELECT id, nombre from categoria WHERE id='.$id);
        return $categoria->fetch();
    }

    public function actualizaCategoria($id, $nombre){
        $this->_db->prepare("UPDATE categoria SET  nombre = :nombre WHERE id = :id")
                    ->execute(array(
                            ':nombre'=> $nombre,
                            ':id'=>$id
                    ));
    }
    
    public function insertarProducto($nombre, $referencia, $precio, $peso, $categoria, $stock, $fecha){
        $ahora = date('Y-m-d');
        $this->_db->prepare("INSERT INTO productos VALUES (NULL, :nombre, :referencia, :precio, :peso, :idCategoria, :stock, :fechaCreacion, :estado)")
                    ->execute(
                            array(
                                ':nombre'=>$nombre,
                                ':referencia'=>$referencia,
                                ':precio'=>$precio,
                                ':peso'=>$peso,
                                ':idCategoria'=>$categoria,
                                ':stock'=>$stock,
                                ':fechaCreacion'=>$ahora,
                                ':estado'=>'0'
                            ));
    }

    public function insertarCategoria($nombre){
        $this->_db->prepare("INSERT INTO categoria VALUES (NULL, :nombre)")
            ->execute(
                    array(
                        ':nombre'=>$nombre
                    ));
    }

    public function getProductosActivos($estado){
        $productos = $this->_db->query('SELECT P.id, P.nombre, P.referencia, P.precio, P.peso, P.idCategoria, P.stock, C.nombre AS "categoria", P.fechaCreacion, P.estado
                FROM productos P
            INNER JOIN categoria C ON C.id = P.idCategoria
            WHERE estado = '.$estado);
        return $productos->fetchall();
    }

    public function getProducto($id){
        $id = (int) $id;
        $producto = $this->_db->query('SELECT P.id, P.nombre, P.referencia, P.precio, P.peso, P.idCategoria, P.stock, C.nombre AS "categoria", P.fechaCreacion, P.estado
                FROM productos P
            INNER JOIN categoria C ON C.id = P.idCategoria
            WHERE P.id = '.$id);
        return $producto->fetch();
    }

    public function actualizaProducto($id, $nombre, $referencia, $peso, $stock, $categoria, $estado ){
        $this->_db->prepare("UPDATE productos SET nombre = :nombre, referencia = :referencia, peso = :peso, stock =:stock, idCategoria = :idCategoria, estado =:estado WHERE id = :id")
                    ->execute(array(
                                  ':nombre'=>$nombre,
                                  ':referencia'=>$referencia,
                                  ':peso'=>$peso,
                                  ':stock'=>$stock,
                                  ':idCategoria'=>$categoria,
                                  ':estado' => $estado,
                                  ':id'=>$id
                                ));

    }

    public function getProductoStock(){
        $producto = $this->_db->query('SELECT P.id, P.nombre, P.referencia, P.precio, P.peso, P.idCategoria, P.stock, C.nombre AS "categoria", P.fechaCreacion, P.estado
                FROM productos P
            INNER JOIN categoria C ON C.id = P.idCategoria
            WHERE estado = 0
            ORDER BY P.stock DESC');
        return $producto->fetch();

    }
}
?>
