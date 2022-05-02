<?php 
$peticionAjax=true;

    require_once "../config/APP.php";

    if( isset($_POST['caja_movimiento_concepto_reg'])|| 
        isset($_POST['caja_movimiento_id_edit']) ||
        isset($_POST['movimiento_id_del']) ){
        require_once "../controllers/cajaControlador.php";
        $ins_caja = new cajaControlador();


        /** INSRTAR  MOVIMIENTO CAJA */
        if(isset($_POST['caja_movimiento_concepto_reg'])) {
            echo $ins_caja->insertar_caja_movimiento_controlador();
        }
        /**EDITAR MOVIMIENTO CAJA */
        if (isset($_POST['caja_movimiento_id_edit'])){
            echo $ins_caja->editar_caja_movimiento_controlador();
        }

        /**BORRAR MOVIMIENTO CAJA */
        if(isset($_POST['movimiento_id_del'])) {
            echo $ins_caja->borrar_caja_movimiento_controlador();
        }

    } 