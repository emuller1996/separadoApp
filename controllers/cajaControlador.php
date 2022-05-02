<?php

if ($peticionAjax) {
    require_once "../models/cajaModelo.php";
} else {
    require_once "./models/cajaModelo.php";
}

class cajaControlador extends cajaModelo
{


    /**LISTAR MOVIMIENTO DE CAJA HOY */
    public function listar_caja_movimientos_hoy_controlador()
    {
        $listaMovimientoHoy = cajaModelo::listar_caja_movimientos_hoy_modelo();
        $listaMovimientoHoy = $listaMovimientoHoy->fetchAll(PDO::FETCH_ASSOC);
        return $listaMovimientoHoy;
    }

    /**INSERTAR CAJA MOVIMIENTO CONTROLADOR */
    public function insertar_caja_movimiento_controlador()
    {
        $concepto = mainModel::limpiar_cadena($_POST['caja_movimiento_concepto_reg']);
        $valor = mainModel::limpiar_cadena($_POST['caja_movimiento_valor_reg']);
        $tipo = mainModel::limpiar_cadena($_POST['caja_movimiento_tipo_reg']);

        /**VALIDACIONES */

        if ($concepto == "" ||  $valor == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Erorr de Validacion",
                "Texto" => "Los campos obligatorios no ha sido llenados.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($valor <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error en el Valor",
                "Texto" => "el campo Valor debe ser mayor a cero.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        $datos_movimiento = [
            'Valor' => $valor,
            'Tipo' => $tipo,
            'Concepto' => $concepto,
            'Referencia' => 'N/A'
        ];

        $movimiento_ins = cajaModelo::insertar_caja_movimiento_modelo($datos_movimiento);

        if ($movimiento_ins->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Movimiento de Caja Registrado",
                "Texto" => "Los datos del movimiento de la caja han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar el el movimiento",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }


    /**OBTENER MOVIMIENTO DE CAJA POR ID */
    public function get_caja_movimiento_controlador($id)
    {
        $id_edit =  mainModel::decryption($id);
        $sql = mainModel::conectar()->prepare("SELECT * FROM `movimientos_caja` WHERE `movimiento_caja_id` = :Id");
        $sql->bindValue(":Id", $id_edit);
        $sql->execute();
        $caja_movimiento = $sql->fetch(PDO::FETCH_ASSOC);
        return $caja_movimiento;
    }

    /**EDITAR MOVIMIENTO DE CAJA POR ID */
    public function editar_caja_movimiento_controlador()
    {
        $caja_movimiento_id = mainModel::limpiar_cadena($_POST['caja_movimiento_id_edit']);
        $caja_movimiento_concepto = mainModel::limpiar_cadena($_POST['caja_movimiento_concepto_edit']);
        $caja_movimiento_valor = mainModel::limpiar_cadena($_POST['caja_movimiento_valor_edit']);
        $caja_movimiento_tipo = mainModel::limpiar_cadena($_POST['caja_movimiento_tipo_edit']);


        /**Valicacion */
        if (
            $caja_movimiento_id == "" ||
            $caja_movimiento_concepto == "" ||
            $caja_movimiento_valor == "" ||
            $caja_movimiento_tipo == ""
        ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_movimiento_edit = [
            'Valor'=>$caja_movimiento_valor,
            'Tipo'=>$caja_movimiento_tipo,
            'Concepto'=> $caja_movimiento_concepto,
            'Id'=>$caja_movimiento_id
        ];

        $movimiento_edit = cajaModelo::editar_caja_movimiento_modelo($datos_movimiento_edit);


        if($movimiento_edit->rowCount() == 1){
            $alerta = [
				"Alerta" => "redireccionar",
				"URL" =>  SERVERURL . 'caja-hoy/'
			];
        }else{
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos podido modificar el movimiento",
				"Tipo" => "error"
			];
        }
        echo json_encode($alerta);
    }

    /**BORRAR MOVIMIENTO CAJA POR ID */
    public function borrar_caja_movimiento_controlador(){
        $id = mainModel::limpiar_cadena($_POST['movimiento_id_del']);

        $movimiento_del = cajaModelo::borrar_caja_movimiento_modelo($id);

        if($movimiento_del->rowCount() == 1){
            $alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Movimiento de caja Eliminado",
				"Texto" => "Se elimindado los datos del movimiento de la base de datos con exito.",
				"Tipo" => "success"
			];
        }else{
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Error al Eliminar Movimiento",
				"Texto" => "ERROR - ERROR - ERROR - ERROR - ERROR - ERROR - ERROR",
				"Tipo" => "error"
			];
        }


        echo json_encode($alerta);
    }
}
