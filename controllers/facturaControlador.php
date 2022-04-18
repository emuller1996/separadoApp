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
    }
    /**Fin Del Controlador */

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
    }

    /** Eliminar Cliente Factura */
    public function borrar_cliente_factura_controlador(){

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

    }
}
