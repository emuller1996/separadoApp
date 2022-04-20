<?php 

require_once "mainModel.php";

class facturaModelo extends mainModel {


    /**INSERTAR FACTURA MODELO  */
    protected function insertar_factura_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `facturas`( `factura_fecha`, `factura_total`, `factura_hora`, `factura_estado_estado`, `factura_estado`, `cliente_id`) 
            VALUES (now(),:Total,now(),'CANCELADA',1,:Cliente_id)"
        );
        $sql->bindParam(":Total", $datos['Total']);
        $sql->bindParam(":Cliente_id", $datos['Cliente_id']);
        $sql->execute();
        return $sql;
    }/** FIN CONTROLADOR */


    /** INSERTAR DELTALLES FACTURA*/
    protected function insertar_detalles_factura_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `detalles_facturas`( `producto_id`, `factura_id`, `detalle_cantidad`, `detalle_valor_total`, `detalle_valor_unitario`) 
            VALUES (:Producto_Id,:Factura_Id,:Detalle_Cantidad,:Detalle_Valor_Total,:Detalle_Valor_Unitario)"
        );

        $sql->bindParam(":Producto_Id", $datos['Producto_Id']);
        $sql->bindParam(":Factura_Id", $datos['Factura_Id']);
        $sql->bindParam(":Detalle_Cantidad", $datos['Detalle_Cantidad']);
        $sql->bindParam(":Detalle_Valor_Total", $datos['Detalle_Valor_Total']);
        $sql->bindParam(":Detalle_Valor_Unitario", $datos['Detalle_Valor_Unitario']);
        $sql->execute();
        return $sql;

    }

    protected function get_id_factura(){
        $sql = mainModel::conectar()->prepare('SELECT COUNT(factura_id) FROM `facturas`');
        $sql->execute();
        return $sql->fetch();
    } 


    protected function get_facturas_emitidas_hoy_modelo(){
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM clientes  INNER JOIN facturas using(cliente_id) WHERE factura_fecha = CURDATE()"
        );
        $sql->execute();
        return $sql;
    }



}