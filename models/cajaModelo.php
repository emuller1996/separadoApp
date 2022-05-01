<?php 

require_once "mainModel.php";

class cajaModelo extends mainModel {
    
    /**LISTAR MOVIMIENTO DE CAJA HOY */
    protected function listar_caja_movimientos_hoy_modelo(){
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM `movimientos_caja` WHERE movimiento_caja_fecha = CURRENT_DATE() ORDER by movimiento_caja_id  ASC"
        );
        $sql->execute();
        return $sql;
    }

    protected function insertar_caja_movimiento_modelo($datos){
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `movimientos_caja`( `movimiento_caja_fecha`, `movimiento_caja_hora`, `movimiento_caja_valor`, `movimiento_caja_tipo`, `movimiento_caja_concepto`, `movimiento_caja_referencia`) 
            VALUES (NOW(),NOW(),:Valor,:Tipo,:Concepto,:Referencia)"
        );
        $sql->bindParam(":Valor", $datos['Valor']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->bindParam(":Concepto", $datos['Concepto']);
        $sql->bindParam(":Referencia", $datos['Referencia']);
        $sql->execute();
        return $sql;
    }
}