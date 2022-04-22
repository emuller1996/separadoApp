<?php

if ($peticionAjax) {
	require_once "../models/separadoModelo.php";
} else {
	require_once "./models/separadoModelo.php";
}

class separadoControlador extends separadoModelo{

    /**LISTAR SEPARADOS  */
    public function listar_separados_controlador()
    {
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM clientes  INNER JOIN facturas using(cliente_id) 
            INNER JOIN separados using(factura_id)"
        );
        $sql->execute();
        $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $sql; 
    }

    //** OBTENER SEPARADO */
    public function get_separado_controlador($id)
    {
        $id_separado = mainModel::limpiar_cadena($id);
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM separados INNER JOIN facturas using(factura_id)
            INNER JOIN clientes using(cliente_id) WHERE separado_id = :Id_Separado;"
        );
        $sql->bindParam(":Id_Separado",$id_separado);
        $sql->execute();
        $sql = $sql->fetch(PDO::FETCH_ASSOC);
        return $sql;

    }
    /**OBTENER ABONOS SEPARADOS */
    public function get_abono_separado_controlador($id)
    {
        $id_separado = mainModel::limpiar_cadena($id);
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM  abonos  WHERE separado_id = :Id_Separado;"
        );
        $sql->bindParam(":Id_Separado",$id_separado);
        $sql->execute();
        $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $sql;
    }

    /** INSERTAR ABONO SEPARADO */
    public function insertar_abono_separado_controlador(){
        $separado_id = mainModel::limpiar_cadena($_POST['abono_separado_id_reg']);
        $valor_abono = mainModel::limpiar_cadena($_POST['abono_valor_reg']);
        $separado_abonado_total = mainModel::limpiar_cadena($_POST['separado_abonado_total_reg']);
        $separado_saldo_actual= mainModel::limpiar_cadena($_POST['separado_saldo_actual_reg']);
        $factura_id= mainModel::limpiar_cadena($_POST['factura_id_h']);
        $errors=0;
        
        $estado='PENDIENTE';
        if($separado_id=="" && $valor_abono=""){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }
        
        $datos_abono_insert = [
            'Valor'=> $valor_abono,
            'Separado' =>$separado_id
        ];

        $abono_insert = separadoModelo::insertar_abono_separado_modelo($datos_abono_insert);

        if($abono_insert->rowCount()!= 1){
            $errors++;            
        }

        if($separado_saldo_actual==0){
            $estado='PAGADO';
            $factura_edir = separadoModelo::actualizar_factura_separado_abono_modelo($factura_id);
            if($factura_edir->rowCount()!= 1){
                $errors++;
            } 
        }
        $datos_separado_edit = [
            'Saldo' => $separado_saldo_actual,
            'Estado'=> $estado,
            'Abonado'=> $separado_abonado_total,
            'Ultimo_Valor_Abono' => $valor_abono,
            'Separado' => $separado_id                
        ];

        $separado_edit = separadoModelo::actualizar_saldo_separado($datos_separado_edit);

        if($separado_edit->rowCount()!=1){
            $errors++;
            $alerta = [
                "Alerta" => "al cargar separado",
                "Titulo" => "Abono Registrado",
                "Texto" => "Los datos del Abono han sido registrados con exito",
                "Tipo" => "error"
            ];
        }
        

        if($errors==0){
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Abono Registrado",
                "Texto" => "Los datos del Abono han sido registrados con exito",
                "Tipo" => "success"
            ];

        }else{
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Error al Registro del Abono",
                "Texto" => "Los datos del usuario han sido registrados con exito",
                "Tipo" => "error"
            ];
            
        }

        echo json_encode($alerta);


    }

}





?>