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
        $estado_factura='CANCELADA';
        $valor_movimiento = $total;

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

        if($_POST['tipo_factura']=='SEPARADO'){
            $estado_factura='PENDIENTE';
        }


        /** Datos para Registrar Factura */
        $datos_factura_reg = [
            'Total' =>$total,
            'Estado' =>$estado_factura,
            'Cliente_id' => $_SESSION['datos_cliente']['ID']
        ];

        /**Registro Factura  */
        $factura_insert = facturaModelo::insertar_factura_modelo($datos_factura_reg);


        /** Validacion de la Sentencia */
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

        //Obtener el ID de la Factura
        $n_factura = facturaModelo::get_id_factura();      
        $detalle_error= 0;

        /** INSERT DETALLES DE LA VENTA */
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

        /**Datos Separado */
        $concepto = 'VENTA FACTURA : FT- ' . $n_factura['COUNT(factura_id)'];

        if($_POST['tipo_factura']=='SEPARADO'){
            $saldo = mainModel::limpiar_cadena($_POST['separado_saldo_reg']);
            $Abono = mainModel::limpiar_cadena($_POST['separado_abonado_reg']);
            $concepto = 'ABONO SEPARADO : FT- ' . $n_factura['COUNT(factura_id)'];

            $valor_movimiento = $Abono;
            /**Datos de Separado Insert */
            $datos_separado_insertar = [
                'Saldo' =>$saldo,
                'Abono' =>$Abono,
                'Ultimo_Valor_Abono' =>$Abono,
                'Factura'=> $n_factura['COUNT(factura_id)']
            ];

            $separado_insert =  facturaModelo::insertar_separado_factura_modelo($datos_separado_insertar);
            if($separado_insert->rowCount() != 1){
                $detalle_error++;
            }else{
                /** Datos Abono Separado */
                $id_separado  = mainModel::ejecutar_consulta_simple("SELECT COUNT(separado_id) FROM separados");
                $id_separado = $id_separado->fetch();

                $datos_abono_insert = [
                    'Abono' => $Abono,
                    'Separado' =>$id_separado['COUNT(separado_id)']
                ];

                $abono_insert =  facturaModelo::insertar_abono_separado_factura_modelo($datos_abono_insert);

                if($abono_insert->rowCount()!=1){
                    $detalle_error++;
                }
            }
        }


        /** INSERT MOVIMIENTO CAJA CONTROLADOR */
        
        $datos_movimiento = [
            'Valor' => $valor_movimiento,
            'Tipo' => 'ENTRADA',
            'Concepto'=> $concepto ,
            'Referencia' => 'FT- ' . $n_factura['COUNT(factura_id)']
        ];
        $movimiento_ins = facturaModelo::insertar_moviento_caja_modelo($datos_movimiento);
        
        if($movimiento_ins->rowCount()!=1){
            $detalle_error++;
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
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Error al Facturar",
				"Texto" => "la factura no se ha podido registrar.",
				"Tipo" => "error"
			];

        }
        echo json_encode($alerta);
    }/**Fin Del Controlador*/

    /**Obtener Facturas Emitidas Hoy Controlador */
    public function get_facturas_emitidas_hoy_controlador()
    {
        
        $sql = facturaModelo::get_facturas_emitidas_hoy_modelo();
        $listaFacturasEmitidas = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $listaFacturasEmitidas;
    }/**Fin Del Controlador*/

    /**Obteer Codigo Factura  */
    public function get_facturas_id_controlador()
    {
        $n_factura = facturaModelo::get_id_factura();    
        return $n_factura;
    }
    /** OBTENER FACTURA POR FACTURA_ID CONTROLADOR*/
    public function get_factura_by_id_controlador($id)
    {
        $factura_id = mainModel::limpiar_cadena($id);
        $factura = facturaModelo::get_factura_by_id_modelo($factura_id);
        $factura = $factura->fetch(PDO::FETCH_ASSOC);
        return $factura;
    }

    /**OBTENER DETALLES FACTURA CONTROLADOR */
    public function get_detalles_factura_controlador($id)
    {
        $factura_id = mainModel::limpiar_cadena($id);
        $detalles_factura = facturaModelo::get_detalles_factura_modelo($factura_id);
        $detalles_factura = $detalles_factura->fetchAll(PDO::FETCH_ASSOC);
        return $detalles_factura;
    }


    /** Buscar Factura por Fechas */
    public function buscar_factura_por_fechas_controlador()
    {

        $fecha_inicio = mainModel::limpiar_cadena($_POST['factura_buscar_fecha_inicio']);
        $fecha_fin = mainModel::limpiar_cadena($_POST['factura_buscar_fecha_fin']);

        /**Validacion de Campos */
        if($fecha_fin ==""  || $fecha_inicio == ""){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Error en la validacion de datos",
				"Texto" => "las fechas son obligatorias, por favor rellene los campos.",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
            
        }
        $alerta = [
            "Alerta" => "redireccionar",
            "URL" => SERVERURL. "facturas-por-fecha/".$fecha_inicio."/".$fecha_fin
            
        ];
        echo json_encode($alerta);
    }

    /**  */
    public function listar_facturas_por_fecha_controlador($inicio,$fin)
    {
        $fecha_inicio = mainModel::limpiar_cadena($inicio);
        $fecha_fin = mainModel::limpiar_cadena($fin);

        $sql = facturaModelo::listar_facturas_por_fecha_modelo($fecha_inicio,$fecha_fin);
        $listaFacturas =$sql->fetchAll(PDO::FETCH_ASSOC);
        return $listaFacturas;
    }



    

}
