<?php 

require_once "mainModel.php";

class facturaModelo extends mainModel {


    /**INSERTAR FACTURA MODELO  */
    protected function insertar_factura_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `facturas`( `factura_fecha`, `factura_total`, `factura_hora`, `factura_estado_estado`, `factura_estado`, `cliente_id`) 
            VALUES (now(),:Total,now(),:Estado,1,:Cliente_id)"
        );
        $sql->bindParam(":Total", $datos['Total']);
        $sql->bindParam(":Estado", $datos['Estado']);
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

    /**OBTENER ID DE ULTIMA FACTURA */
    public static function get_id_factura()
    {
        $sql = mainModel::conectar()->prepare('SELECT COUNT(factura_id) FROM `facturas`');
        $sql->execute();
        return $sql->fetch();
    } 

    /** OBTENER FACTURAS HOY */
    protected function get_facturas_emitidas_hoy_modelo()
    {
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM clientes  INNER JOIN facturas using(cliente_id) WHERE factura_fecha = CURDATE()"
        );
        $sql->execute();
        return $sql;
    }

    /**Agregar Separado Factura */
    public function insertar_separado_factura_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `separados`( 
                            `separado_fecha_inicio`, 
                            `separado_fecha_vencimiento`,
                            `separado_saldo`, 
                            `separarado_estado_estado`, 
                            `separado_abonado`, 
                            `separado_estado`, 
                            `separado_ultimo_valor_abono`, 
                            `separado_ultimo_fecha_abono`, 
                            `factura_id`) 
            VALUES (
                            NOW(),
                            date_add(now(),INTERVAL 30 DAY),
                            :Saldo,
                            'PENDIENTE',
                            :Abono,
                            1,
                            :Ultimo_Valor_Abono,
                            NOW(),
                            :Factura
                            )"
        );
        $sql->bindParam(":Saldo", $datos['Saldo']);
        $sql->bindParam(":Abono", $datos['Abono']);
        $sql->bindParam(":Ultimo_Valor_Abono", $datos['Ultimo_Valor_Abono']);
        $sql->bindParam(":Factura", $datos['Factura']);
        $sql->execute();
        return $sql;
        
    }


    /**INSERTAR ABONO SEPARADO FACTURA MODELO */
    protected function insertar_abono_separado_factura_modelo($datos){
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `abonos`( `abono_valor`, `abono_fecha`, `separado_id`) 
            VALUES (:Abono,now(),:Separado)"
        );
        $sql->bindParam(":Abono", $datos['Abono']);
        $sql->bindParam(":Separado", $datos['Separado']);
        $sql->execute();
        return $sql;
    }

    /**OBTENER FACTURA POR FACTURA_ID MODELO*/
    protected function get_factura_by_id_modelo($id)
    {
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM clientes  INNER JOIN facturas using(cliente_id) where factura_id = :id;"
        );
        $sql->bindParam(":id",$id);
        $sql->execute();
        return $sql;
    }

    /**OBTENER DETALLES FACTURA MODELO */
    protected function get_detalles_factura_modelo($id)
    {
        $sql = mainModel::conectar()->prepare(
            "SELECT df.detalle_cantidad,p.producto_descripcion,df.detalle_valor_unitario,df.detalle_valor_total 
            FROM facturas as f INNER JOIN detalles_facturas as df using(factura_id)
            INNER JOIN productos as p using (producto_id)
            WHERE factura_id = :id"
        );
        $sql->bindParam(":id",$id);
        $sql->execute();
        return $sql;
    }

    protected function listar_facturas_por_fecha_modelo($inicio,$fin)
    {
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM clientes  INNER JOIN facturas using(cliente_id) WHERE factura_fecha BETWEEN :Inicio AND :Fin ORDER BY factura_id ASC"
        );
        $sql->bindParam(":Inicio",$inicio);
        $sql->bindParam(":Fin",$fin);
        $sql->execute();
        return $sql; 

    }



}