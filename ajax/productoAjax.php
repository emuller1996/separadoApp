<?php 

    $peticionAjax=true;

    require_once "../config/APP.php";

    if(isset($_POST['producto_codigo_reg']) || isset($_POST['producto_id_del'])){
        require_once "../controllers/productosControlador.php";
		$ins_producto = new productosControlador();
        if(isset($_POST['producto_codigo_reg'])&& isset($_POST['producto_descripcion_reg']) ){
            echo $ins_producto->insertar_producto_controlador();
        }

        if(isset($_POST['producto_id_del'])){

            echo $ins_producto->delete_producto_controlador();
            
        }



    }
    
?>