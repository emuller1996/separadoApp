<?php 

require_once "mainModel.php";

class empresaModelo extends mainModel {


    /**INSERTAR EMPRESA MODELO */
    protected function insertar_empresa_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare(
            "INSERT INTO `empresa`( `empresa_razon_social`, `empresa_nit`, `empresa_telefono`, `empresa_representante`, `empresa_direccion`, `empresa_cuidad`, `empresa_departamento`, `empresa_url_imagen`) 
            VALUES (:Razon_Social,:Nit,:Telefono,:Representante,:Direccion,:Cuidad,:Departamento,:ruta)"
        );
        $sql->bindParam(":Razon_Social", $datos['Razon_Social']);
        $sql->bindParam(":Nit", $datos['Nit']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Representante", $datos['Representante']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->bindParam(":Cuidad", $datos['Cuidad']);
        $sql->bindParam(":Departamento", $datos['Departamento']);
        $sql->bindParam(":ruta", $datos['Url']);
        $sql->execute();
        return $sql;
    }

}

?>