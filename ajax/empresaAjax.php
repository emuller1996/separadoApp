<?php 

$peticionAjax=true;

    require_once "../config/APP.php";


    if(isset($_POST['empresa_razo_social_reg'])){
        require_once "../controllers/empresaControlador.php";
        $ins_empresa = new empresaControlador();

        if(isset($_POST['empresa_razo_social_reg'])){
            echo $ins_empresa->insertar_empresa_controlador();
        }



    }



    ?>