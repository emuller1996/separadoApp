<?php 

if ($peticionAjax) {
	require_once "../models/productoModelo.php";
} else {
	require_once "./models/productoModelo.php";
}

class productosControlador extends productoModelo{


    public function producto_all_controlador(){
        $consulta = "SELECT * FROM `productos` WHERE producto_estado =1 ";
		$conexion = mainModel::conectar();
		$SQL = $conexion->prepare($consulta);
        $SQL->execute();
		$datos = $SQL->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function insertar_producto_controlador(){
        $producto_codigo = mainModel::limpiar_cadena($_POST['producto_codigo_reg']);
        $producto_existencia = mainModel::limpiar_cadena($_POST['producto_existencia_reg']);
        $producto_descripcion = mainModel::limpiar_cadena($_POST['producto_descripcion_reg']);
        $producto_costo = mainModel::limpiar_cadena($_POST['producto_costo_reg']);
        $producto_precio = mainModel::limpiar_cadena($_POST['producto_precio_reg']);

        if($producto_codigo == "" || $producto_existencia == "" || $producto_descripcion == "" || $producto_costo == "" || $producto_precio == ""){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }

        $datos_producto_reg = [
			"Codigo" => $producto_codigo,
			"Descripcion" => $producto_descripcion,
			"Costo" => $producto_costo,
			"Precio" => $producto_precio,
			"Existencia" => $producto_existencia
		];

		$agregar_producto = productoModelo::insertar_producto_modelo($datos_producto_reg);


		if ($agregar_producto->rowCount() == 1) {
			$alerta = [
				"Alerta" => "limpiar",
				"Titulo" => "usuario registrado",
				"Texto" => "Los datos del usuario han sido registrados con exito",
				"Tipo" => "success"
			];
		} else {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => $agregar_producto->rowCount() ."No hemos podido registrar el usuario",
				"Tipo" => "error"
			];
		}
		echo json_encode($alerta);

    }

	public function delete_producto_controlador(){
		$id = mainModel::decryption($_POST['producto_id_del']);
		$id =mainModel::limpiar_cadena($id);

		$usuario_del = productoModelo::delete_producto_modelo($id);
		if ($usuario_del->rowCount() == 1) {
			$alerta = [
				"Alerta" => "limpiar",
				"Titulo" => "usuario registrado",
				"Texto" => "Los datos del usuario han sido registrados con exito",
				"Tipo" => "success"
			];
		} else {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No hemos podido registrar el usuario",
				"Tipo" => "error"
			];
		}
		echo json_encode($alerta);


	}


}

?>