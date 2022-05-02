<?php 

require_once "mainModel.php";

class cajaModelo extends mainModel {
    
    
    /**LISTAR MOVIMIENTO DE CAJA HOY */
    protected function listar_caja_movimientos_hoy_modelo()
    {
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM `movimientos_caja` WHERE movimiento_caja_fecha = CURRENT_DATE() ORDER by movimiento_caja_id  ASC"
        );
        $sql->execute();
        return $sql;
    }


    /** INSERTAR CAJA MOVIMIENTO MODELO */
    protected function insertar_caja_movimiento_modelo($datos)
    {
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


    /**EDITAR CAJA MOVIMIENTO MODELO */
    protected function editar_caja_movimiento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare(
            "UPDATE `movimientos_caja` SET `movimiento_caja_valor`=:Valor,`movimiento_caja_tipo`=:Tipo,`movimiento_caja_concepto`=:Concepto WHERE `movimiento_caja_id` = :Id"
        );
        $sql->bindParam(":Valor", $datos['Valor']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->bindParam(":Concepto", $datos['Concepto']);
        $sql->bindParam(":Id", $datos['Id']);
        $sql->execute();
        return $sql;

    }


    /** BORRAR CAJA MOVIMIENTO MODELO */
    protected function borrar_caja_movimiento_modelo($id)
    {
        $sql= mainModel::conectar()->prepare(
            "DELETE FROM `movimientos_caja` WHERE `movimiento_caja_id` = :Id"
        );
        $sql->bindParam(":Id",$id);
        $sql->execute();
        return $sql;
    }
}