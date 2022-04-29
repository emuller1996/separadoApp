<?php 

    $peticionAjax=true;

    require_once "../config/APP.php";

    if(isset($_POST['rubro_nombre_reg'])   ){
        require_once "../controllers/rubroControlador.php";
        $ins_rubroContorlador = new rubroControlador();


        /**Agregar Rubro */
        if( isset($_POST['rubro_nombre_reg']) &&  isset($_POST['rubro_descripcion_reg']) ){
            echo $ins_rubroContorlador->insertar_rubro_controlador();
        }

    }