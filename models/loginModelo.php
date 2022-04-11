<?php 

require_once "mainModel.php";

class loginModelo extends mainModel{

    /** inicio de session */
    protected function iniciar_sesion_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE 
        usuario_usuario= :usuario AND usuario_pass= :clave AND usuario_estado = 'ACTIVO'" );
        $sql->bindParam(':usuario',$datos['usuario']);
        $sql->bindParam(':clave',$datos['clave']);
        $sql->execute();
        return $sql;
    }

}