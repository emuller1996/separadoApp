<?php 

    $peticionAjax=true;

    require_once "../config/APP.php";

    if(isset($_POST['usuario_nombre_reg'])){
        require_once "../controllers/usuarioControlador.php";
		$ins_usuario = new usuarioControlador();

        if(isset($_POST['usuario_nombre_reg'])&& isset($_POST['usuario_apellido_reg']) ){
            echo $ins_usuario->insertar_usuario_controlador();
		
        }
    }


?>