<?php 

if ($peticionAjax) {
    require_once "../models/clienteModelo.php";
} else {
    require_once "./models/clienteModelo.php";
}

class clienteControlador extends clienteModelo {
    

    /** INSERTAR CLIENTE CONTROLADOR */
    public function insertar_cliente_controlador(){
        $cliente_documento = mainModel::limpiar_cadena($_POST['cliente_documento_reg']);
        $cliente_telefono = mainModel::limpiar_cadena($_POST['cliente_telefono_reg']);
        $cliente_nombre = mainModel::limpiar_cadena($_POST['cliente_nombre_reg']);
        $cliente_correo= mainModel::limpiar_cadena($_POST['cliente_correo_reg']);

        /** VALIDAR CAMPOS  */
        if ($cliente_nombre == "" || $cliente_documento == "" || $cliente_telefono == "" || $cliente_correo == "" ){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }/** VALIDAR CAMPOS  */

        /** VALIDAR DOCUMENTO */
        $cliente_validar_documeto = clienteModelo::validar_documento_cliente_modelo($cliente_documento);
        if($cliente_validar_documeto->rowCount() == 1){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "El Documento del Cliente ya se encuentra en el sistema.",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }
        /** VALIDAR DOCUMENTO */

        $datos_insertar_cliente = [
            "Nombre" => $cliente_nombre,
            "Cedula" => $cliente_documento,
            "Telefono" => $cliente_telefono,
            "Correo" => $cliente_correo
        ];

        $cliente_insertado = clienteModelo::insertar_cliente_modelo($datos_insertar_cliente);

        if($cliente_insertado->rowCount() == 1){
            $alerta = [
				"Alerta" => "limpiar",
				"Titulo" => "Cliente Registrado",
				"Texto" => "Los datos del Cliente han sido registrados con exito",
				"Tipo" => "success"
			];
        }else{
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos podido registrar el Cliente",
				"Tipo" => "error"
			];
        }
        echo json_encode($alerta);
    }
    /** FIN INSERTAR CLIENTE CONTROLADOR */


    /**LISTAR CLIENTES CONTROLADOR */
    public function listar_clientes_controlador(){
        $consulta = "SELECT * FROM `clientes` WHERE cliente_estado =1 ";
		$conexion = mainModel::conectar();
		$SQL = $conexion->prepare($consulta);
        $SQL->execute();
		$datos = $SQL->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    /**FIN LISTAR CLIENTES CONTROLADOR */

}


?>