<?php 
require_once "mainModel.php";


class usuarioModelo extends mainModel {

/**Modelo Agregar Usuario */
protected static function insertar_usuario_modelo($datos){
    $sql=mainModel::conectar()->prepare(
        "INSERT INTO `usuarios`(`usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_pass`, `usuario_email`, `usuario_telefono`, `usuario_estado`) 
        VALUES (:Nombre,:Apellido,:Usuario,:Clave,:Email,:Telefono,'ACTIVO')");
    $sql->bindParam(":Nombre",$datos['Nombre']);
    $sql->bindParam(":Apellido",$datos['Apellido']);
    $sql->bindParam(":Usuario",$datos['Usuario']);
    $sql->bindParam(":Clave",$datos['Clave']);
    $sql->bindParam(":Email",$datos['Email']);
    $sql->bindParam(":Telefono",$datos['Telefono']);
    $sql->execute();

    return $sql;
}




}


?>