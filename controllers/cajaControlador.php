<?php 

if ($peticionAjax) {
    require_once "../models/cajaModelo.php";
} else {
    require_once "./models/cajaModelo.php";
}

class cajaControlador extends cajaModelo {


    /**LISTAR MOVIMIENTO DE CAJA HOY */
    public function listar_caja_movimientos_hoy_controlador(){
        $listaMovimientoHoy = cajaModelo::listar_caja_movimientos_hoy_modelo();
        $listaMovimientoHoy = $listaMovimientoHoy->fetchAll(PDO::FETCH_ASSOC);
        return $listaMovimientoHoy;
    }

    /**INSERTAR CAJA MOVIMIENTO CONTROLADOR */
    public function insertar_caja_movimiento_controlador(){
        $concepto = mainModel::limpiar_cadena($_POST['caja_movimiento_concepto_reg']);
        $valor = mainModel::limpiar_cadena($_POST['caja_movimiento_valor_reg']);
        $tipo = mainModel::limpiar_cadena($_POST['caja_movimiento_tipo_reg']);

        /**VALIDACIONES */

        if($concepto == ""||  $valor == ""){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Erorr de Validacion",
				"Texto" => "Los campos obligatorios no ha sido llenados.",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }

        if($valor <= 0){
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
            'Tipo' =>$tipo,
            'Concepto' => $concepto,
            'Referencia' => 'N/A'
        ];

        $movimiento_ins = cajaModelo::insertar_caja_movimiento_modelo($datos_movimiento);

        if($movimiento_ins->rowCount() == 1){
            $alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Movimiento de Caja Registrado",
				"Texto" => "Los datos del movimiento de la caja han sido registrados con exito",
				"Tipo" => "success"
			];
        }else{
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos podido registrar el el movimiento",
				"Tipo" => "error"
			];
        }
        echo json_encode($alerta);




    }
}