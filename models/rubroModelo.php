<?php
require_once "mainModel.php";

class rubroModelo extends mainModel {


    protected function insertar_rubro_modelo($datos){
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `rubros`( `rubro_nombre`, `rubro_descripcion`) VALUES (:Nombre,:Descripcion)"
        );
        $sql->bindParam(":Nombre",$datos['Nombre']);
        $sql->bindParam(":Descripcion",$datos['Descripcion']);
        $sql->execute();
        return $sql;
    }

}