<?php 
$peticionAjax=true;

    require_once "../config/APP.php";

    if( isset($_POST['caja_movimiento_concepto_reg'])){
        require_once "../controllers/cajaControlador.php";
        $ins_caja = new cajaControlador();


        /** INSRTAR  MOVIMIENTO CAJA */
        if(isset($_POST['caja_movimiento_concepto_reg'])) {
            echo $ins_caja->insertar_caja_movimiento_controlador();
        }
    } 