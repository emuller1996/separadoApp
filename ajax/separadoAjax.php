<?php 
$peticionAjax=true;

    require_once "../config/APP.php";

    if( isset($_POST['abono_separado_id_reg']) )
    {
        require_once "../controllers/separadoControlador.php";
		$ins_separado = new separadoControlador();

        /**Agregar Abono */
        if( isset($_POST['abono_separado_id_reg'])){
            echo $ins_separado->insertar_abono_separado_controlador();
        }

    }