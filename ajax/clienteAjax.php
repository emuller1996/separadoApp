<?php 

$peticionAjax=true;

    require_once "../config/APP.php";

    if(isset($_POST['cliente_documento_reg'])){
        require_once "../controllers/clienteControlador.php";
        $ins_cliente = new clienteControlador();

        if(isset($_POST['cliente_documento_reg'])){
            echo $ins_cliente->insertar_cliente_controlador();
        }



    }


?>