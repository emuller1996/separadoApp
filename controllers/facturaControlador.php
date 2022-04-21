<?php

if ($peticionAjax) {
    require_once "../models/facturaModelo.php";
} else {
    require_once "./models/facturaModelo.php";
}

class facturaControlador extends facturaModelo
{
    /** Controlador BuscarCliente Factura */
    public function buscar_cliente_factura_controlador()
    {
        $cliente_buscar  = mainModel::limpiar_cadena($_POST['buscar_cliente']);



        $datos_clientes = mainModel::ejecutar_consulta_simple("SELECT * FROM clientes WHERE cliente_cedula LIKE '%$cliente_buscar%' OR cliente_nombre LIKE '%$cliente_buscar%'");

        if ($datos_clientes->rowCount() >= 1) {
            $lista_clientes = $datos_clientes->fetchAll(PDO::FETCH_ASSOC);
            $table = "";
            $table .= '<table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>&nbsp;</th>
            </thead>
            <tbody>';

            foreach ($lista_clientes as $cliente) {
                $table .= '<tr>
                    <td>' . $cliente['cliente_id'] . ' </td> 
                    <td> ' . $cliente['cliente_cedula'] . ' </td>
                    <td> ' . $cliente['cliente_nombre'] . ' </td>
                    <td> 
                        <button type="button" onclick="agregar_cliente('.$cliente['cliente_id'].')" class="btn btn-primary" >
                        <i class="fas fa-user-plus"></i>
                        </button>
                    <td>
                </tr>';
            }

            $table .= '</tbody></table>';
            return $table;
        } else {
            return '
            <div class="alert alert-warning" role="alert">
            No se encuentra coincidencias de "' .$cliente_buscar .'" en la Base de datos de Clientes
            </div>';
        }
    } /**Fin Del Controlador */

    /** Controlador Agregar Cliente Factura*/
    public function agregar_cliente_factura_controlador()
    {
        $id = mainModel::limpiar_cadena($_POST['id_agregar_cliente']);

        $check_cliente = mainModel::ejecutar_consulta_simple("SELECT * FROM clientes WHERE cliente_id ='$id'");
        if($check_cliente->rowCount() <= 0){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos encontrado el cliente en la base de datos",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }else{
            $campos = $check_cliente->fetch();

            session_start(['name' => 'SPM']);
            if(empty($_SESSION['datos_cliente'])){
                $_SESSION['datos_cliente'] = [
                    "ID"=> $campos['cliente_id'],
                    "Documento" => $campos['cliente_cedula'],
                    "Nombre" => $campos['cliente_nombre']
                ];
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Cliente Agregado",
                    "Texto" => "El cliente se ha agreado para la factura o separado",
                    "Tipo" => "success"
                ];
                echo json_encode($alerta);
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "No hemos encontrado el cliente en la base de datos",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();

            }
           

        }
    }/**Fin Del Controlador */

    /** Eliminar Cliente Factura */
    public function borrar_cliente_factura_controlador()
    {

        session_start(['name' => 'SPM']);
        unset($_SESSION['datos_cliente']);
        if(empty($_SESSION['datos_cliente'])){
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Cliente Eliminado",
                "Texto" => "los datos del cliente se ha Eliminado con exito.",
                "Tipo" => "success"
            ];
        }else{
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error Cliente Borrar",
                "Texto" => "los datos del cliente se ha Eliminado con exito.",
                "Tipo" => "error"
            ];

        }
        echo json_encode($alerta);

    }/**Fin Del Controlador */


    /**Buscar Producto Factura Controlador */
    public function buscar_producto_factura_controlador()
    {
        $producto_buscar  = mainModel::limpiar_cadena($_POST['buscar_producto']);
        $datos_productos = mainModel::ejecutar_consulta_simple("SELECT * FROM productos WHERE producto_codigo LIKE '%$producto_buscar%' OR producto_descripcion LIKE '%$producto_buscar%' AND producto_estado = 1");

        if ($datos_productos->rowCount() >= 1) {
            $lista_productos = $datos_productos->fetchAll(PDO::FETCH_ASSOC);
            $table = "";
            $table .= '<table class="table table-bordered">
            <thead>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Exis</th>
                <th>&nbsp;</th>
            </thead>
            <tbody>';

            foreach ($lista_productos as $producto){

                $table.= '<tr>
                    <td>'.$producto['producto_codigo'] .'</td>
                    <td>'.$producto['producto_descripcion'] .'</td>
                    <td>'.$producto['producto_precio'] .'</td>
                    <td>'.$producto['producto_existencia'] .'</td>
                    <td> 
                        <button type="button" onclick="agregar_producto('.$producto['producto_id'].')" class="btn btn-primary" >
                        <i class="fas fa-cart-plus"></i>
                        </button>
                    <td>
                </tr>';
            }

        }else {
            return '
            <div class="alert alert-warning" role="alert">
            No se encuentra coincidencias de "' .$producto_buscar .'" en la Base de datos de PRODUCTOS
            </div>';
        }
        return $table;
    }/**Fin Del Controlador */


    /**Agregar Producto Factura Controlador*/
    public function agregar_producto_factura_controlador()
    {
        $id = mainModel::limpiar_cadena($_POST['id_producto_agregar_factura']);

        $checkProducto = mainModel::ejecutar_consulta_simple("SELECT * FROM productos WHERE producto_id = '$id' AND  producto_estado = 1");
          
        if($checkProducto->rowCount() <= 0){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos podido selecionar el producto, por favor intente de nuevo.",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }else{
            $campos = $checkProducto->fetch();
        }

        $cantidad = mainModel::limpiar_cadena($_POST['detalle_cantidad']);
        $valor_unitario = mainModel::limpiar_cadena($_POST['detalle_valor_unitario']);
        $valor_total = mainModel::limpiar_cadena($_POST['detalle_valor_total']);

          /** VALIDAR CAMPOS  */
        if (    $cantidad == "" || 
                $valor_unitario == "" || 
                $valor_total == "" ){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }/** VALIDAR CAMPOS  */



        session_start(['name' => 'SPM']);

        if(empty($_SESSION['datos_producto'][$id])){
            $_SESSION['datos_producto'][$id] =[
                'ID' => $campos['producto_id'],
                'Codigo' =>$campos['producto_codigo'],
                'Descripcion' =>$campos['producto_descripcion'],
                'Valor_Unitario' =>$valor_unitario,
                'Cantidad' =>$cantidad,
                'Valor_total' =>$valor_total
            ];


            $alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Producto Agregado.",
				"Texto" => "El producto se ha agregado correctamente para la factura",
				"Tipo" => "success"
			];
            echo json_encode($alerta);
			exit();
        }else{
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Producto Ya ha Sido Agregado.",
				"Texto" => "El producto ya ha sido agregado, no se puede agregar nuevamente.",
				"Tipo" => "error"
			];
            echo json_encode($alerta);
			exit();

        }
  


    }/**Fin Del Controlador */

    /** Eliminar Producto Factura Controlador*/
    public function eliminar_producto_factura_controlador()
    {
        $id = mainModel::limpiar_cadena($_POST['id_eliminar_producto']);
        session_start(['name' => 'SPM']);
        unset($_SESSION['datos_producto'][$id]);
        if(empty($_SESSION['datos_producto'][$id])){
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Producto Eliminado",
                "Texto" => "los datos del Producto se ha Eliminado con exito.",
                "Tipo" => "success"
            ];
        }else{
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error Producto Borrar",
                "Texto" => "los datos del Producto  no se ha Eliminado con exito.",
                "Tipo" => "error"
            ];

        }
        echo json_encode($alerta);
    }/**Fin Del Controlador */

    /** Agregar Factura Controlador */
    public function agregar_factura_controlador()
    {
        $total = mainModel::limpiar_cadena($_POST['total_factura_reg']);
        session_start(['name' => 'SPM']);

        /**Validacion Campo */
        if( !isset($_SESSION['total_productos'] ) || !isset($_SESSION['datos_producto'])){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error en la Facturacion",
				"Texto" => "No se puede realizar la factura, no hay producto selecionados.",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }

        

        /**Valicacion Cliente */
        if(!isset($_SESSION['datos_cliente'])){
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Cliente No Seleccionado",
                "Texto" => "No se ha podido facturar por que el cliente no ha sido selecionado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();

        }


        /** Datos para Registrar Factura */
        $datos_factura_reg = [
            'Total' =>$total,
            'Cliente_id' => $_SESSION['datos_cliente']['ID']
        ];

        $factura_insert = facturaModelo::insertar_factura_modelo($datos_factura_reg);

        if($factura_insert->rowCount() != 1){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error en la Facturacion",
				"Texto" => "No se pudo realizar el registro de la factura.",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }

        $n_factura = facturaModelo::get_id_factura();      
        $detalle_error= 0;

        foreach ($_SESSION['datos_producto'] as $producto ){

            $datos_detalle = [
                'Producto_Id' => $producto['ID'],
                'Factura_Id' => $n_factura['COUNT(factura_id)'],
                'Detalle_Cantidad' => $producto['Cantidad'],
                'Detalle_Valor_Unitario' => $producto['Valor_Unitario'],
                'Detalle_Valor_Total' => $producto['Valor_total']
            ];

            $agregar_detalle = facturaModelo::insertar_detalles_factura_modelo($datos_detalle);

            if($agregar_detalle->rowCount()!=1){
                $detalle_error = 1;
                break;
            }
        }

        if($detalle_error== 0){
            unset($_SESSION['datos_producto']);
            unset($_SESSION['datos_cliente']);
            $alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Factura Registrada",
				"Texto" => "la factura se ha registrado con exito.",
				"Tipo" => "success"
			];
        }else{

        }
        echo json_encode($alerta);
    }/**Fin Del Controlador*/

    /**Obtener Facturas Emitidas Hoy Controlador */
    public function get_facturas_emitidas_hoy_controlador(){
        
        $sql = facturaModelo::get_facturas_emitidas_hoy_modelo();
        $listaFacturasEmitidas = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $listaFacturasEmitidas;
    }/**Fin Del Controlador*/


    /**Obteer Codigo Factura  */
    public function get_facturas_id_controlador(){
        $n_factura = facturaModelo::get_id_factura();    
        return $n_factura;
    }

    

}
