<?php 

    $peticionAjax=true;

    require_once "../config/APP.php";

    if(isset($_POST['producto_codigo_reg'])){
        require_once "../controllers/productosControlador.php";
		$ins_producto = new productosControlador();
        if(isset($_POST['producto_codigo_reg'])&& isset($_POST['producto_descripcion_reg']) ){
            echo $ins_producto->insertar_producto_controlador();
        }



    }
    
?>