<?php
require_once "mainModel.php";
class productoModelo extends mainModel
{


    protected function Productos_all_modelo()
    {
    }

    protected function insertar_producto_modelo($datos)
    {
        
        $sql = mainModel::conectar()->prepare("
        INSERT INTO `productos`( `producto_descripcion`, `producto_codigo`, `producto_costo`, `producto_precio`, `producto_existencia`, `producto_creado`, `producto_editado`, `producto_estado`) 
         VALUES (:Descripcion,:Codigo,:Costo,:Precio,:Existencia, NOW(), NOW(),1)");
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Codigo", $datos['Codigo']);
        $sql->bindParam(":Costo", $datos['Costo']);
        $sql->bindParam(":Precio", $datos['Precio']);
        $sql->bindParam(":Existencia", $datos['Existencia']);
        $sql->execute();
        
        return $sql;
    }

    protected function delete_producto_modelo($id){
        $sql = mainModel::conectar()->prepare("UPDATE productos SET producto_estado=0 WHERE producto_id= :id ");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;

    }
    
    protected function validar_codigo_modelo($codigo){
        $sql = mainModel::conectar()->prepare("SELECT`producto_codigo` FROM `productos` WHERE `producto_codigo` = :Codigo");
        $sql->bindParam(":Codigo", $codigo);
        $sql->execute();
        
        return $sql;


    }
}
