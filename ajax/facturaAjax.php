<?php 
$peticionAjax=true;

    require_once "../config/APP.php";

    if(isset($_POST['buscar_cliente']) || isset($_POST['id_agregar_cliente']) || isset($_POST['factura_cliente_id_del']) ) {
        require_once "../controllers/facturaControlador.php";
		$ins_factura = new facturaControlador();

        /** BUSCAR CLIEETE */
        if(isset($_POST['buscar_cliente'])) {
            echo $ins_factura->buscar_cliente_factura_controlador();
        }

        /** Agregar Cliente */
        if(isset($_POST['id_agregar_cliente'])) {
            echo $ins_factura->agregar_cliente_factura_controlador();
        }

        if(isset($_POST['factura_cliente_id_del'])) {
            echo $ins_factura->borrar_cliente_factura_controlador();
        }
        
    }

    ?>