<?php
require_once "mainModel.php"; 


class separadoModelo extends mainModel {

    protected function insertar_abono_separado_modelo($datos){
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `abonos`( `abono_valor`, `abono_fecha`, `separado_id`) 
            VALUES (:Valor,NOW(),:Separado)"
        );
        $sql->bindParam(":Valor", $datos['Valor']);
        $sql->bindParam(":Separado", $datos['Separado']);
        $sql->execute();
        return $sql;
    }

    protected function actualizar_saldo_separado($datos){
        $sql = mainModel::conectar()->prepare(
            "UPDATE `separados` SET 
            `separado_saldo`=:Saldo,
            `separarado_estado_estado`=:Estado,
            `separado_abonado`= :Abonado,
            `separado_ultimo_valor_abono`=:Ultimo_Valor_Abono,
            `separado_ultimo_fecha_abono`=NOW()
            WHERE `separado_id` = :Separado"
        );
        $sql->bindParam(":Saldo", $datos['Saldo']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Abonado", $datos['Abonado']);
        $sql->bindParam(":Ultimo_Valor_Abono", $datos['Ultimo_Valor_Abono']);
        $sql->bindParam(":Separado", $datos['Separado']);
        $sql->execute();
        return $sql;
    }
    protected function actualizar_factura_separado_abono_modelo($id){
        $sql = mainModel::conectar()->prepare(
            "UPDATE `facturas` SET `factura_estado_estado` = 'CANCELADA' WHERE `facturas`.`factura_id` = :id;"
        );
        $sql->bindParam(":id",$id);
        $sql->execute();
        return $sql;
    }
    
}
?>