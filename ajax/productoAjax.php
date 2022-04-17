<?php 

    $peticionAjax=true;

    require_once "../config/APP.php";

    if(isset($_POST['producto_codigo_reg']) || isset($_POST['producto_id_del']) || isset($_POST['producto_codigo_edit'])){
        require_once "../controllers/productosControlador.php";
		$ins_producto = new productosControlador();

        /**AGREGAR PRODUCTO */
        if(isset($_POST['producto_codigo_reg'])&& isset($_POST['producto_descripcion_reg']) ){
            echo $ins_producto->insertar_producto_controlador();
        }


        /** BORRAR  */
        if(isset($_POST['producto_id_del'])){

            echo $ins_producto->delete_producto_controlador();
            
        }

        /**Editar Producto */
        if(isset($_POST['producto_codigo_edit'])){
            echo $ins_producto->editar_producto_controlador();
        }
        



    }
    
?>