<?php 

require_once "mainModel.php";

class clienteModelo extends mainModel {

    protected function insertar_cliente_modelo ($datos){
        $sql = mainModel::conectar()->prepare(
        "INSERT INTO `clientes`(`cliente_nombre`, `cliente_cedula`, `cliente_fecha`, `cliente_telefono`, `cliente_correo`, `cliente_estado`) 
         VALUES (:Nombre,:Cedula,now(),:Telefono,:Correo,1)"
        );
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Correo", $datos['Correo']);
        $sql->execute();
        return $sql;
    }

    protected function validar_documento_cliente_modelo($documento){
        $sql = mainModel::conectar()->prepare(
            "SELECT cliente_cedula FROM clientes WHERE cliente_cedula = :Documento"
        );
        $sql->bindParam(":Documento",$documento);
        $sql->execute();
        return $sql;
    }

    protected function listar_clientes_modelo(){
        
    }

}


?>