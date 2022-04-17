<?php

if ($peticionAjax) {
	require_once "../models/productoModelo.php";
} else {
	require_once "./models/productoModelo.php";
}

class productosControlador extends productoModelo
{


	public function producto_all_controlador()
	{
		$consulta = "SELECT * FROM `productos` WHERE producto_estado =1 ORDER BY producto_codigo ASC ";
		$conexion = mainModel::conectar();
		$SQL = $conexion->prepare($consulta);
		$SQL->execute();
		$datos = $SQL->fetchAll(PDO::FETCH_ASSOC);
		return $datos;
	}

	public function insertar_producto_controlador()
	{
		$producto_codigo = mainModel::limpiar_cadena($_POST['producto_codigo_reg']);
		$producto_existencia = mainModel::limpiar_cadena($_POST['producto_existencia_reg']);
		$producto_descripcion = mainModel::limpiar_cadena($_POST['producto_descripcion_reg']);
		$producto_costo = mainModel::limpiar_cadena($_POST['producto_costo_reg']);
		$producto_precio = mainModel::limpiar_cadena($_POST['producto_precio_reg']);

		if ($producto_codigo == "" || $producto_existencia == "" || $producto_descripcion == "" || $producto_costo == "" || $producto_precio == "") {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		}


		$consulta_codigo = productoModelo::validar_codigo_modelo($producto_codigo);
		if ($consulta_codigo->rowCount() == 1) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "El codigo del producto ya se encuentra en el sistema.",
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
				"Texto" => $agregar_producto->rowCount() . "No hemos podido registrar el usuario",
				"Tipo" => "error"
			];
		}
		echo json_encode($alerta);
	}

	public function delete_producto_controlador()
	{
		$id = mainModel::decryption($_POST['producto_id_del']);
		$id = mainModel::limpiar_cadena($id);

		$usuario_del = productoModelo::delete_producto_modelo($id);
		if ($usuario_del->rowCount() == 1) {
			$alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Producto Borrado",
				"Texto" => "Los datos del producto han sido eliminados con exito",
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

	public function get_producto_controlador($id)
	{
		$id_user =  mainModel::limpiar_cadena($id);
		$id_user =  mainModel::decryption($id_user);
		$sql = productoModelo::get_producto_modelo($id_user);
		$usuario = $sql->fetch(PDO::FETCH_ASSOC);
		return $usuario;
	}

	public function editar_producto_controlador()
	{
		$producto_codigo = mainModel::limpiar_cadena($_POST['producto_codigo_edit']);
		$producto_existencia = mainModel::limpiar_cadena($_POST['producto_existencia_edit']);
		$producto_descripcion = mainModel::limpiar_cadena($_POST['producto_descripcion_edit']);
		$producto_costo = mainModel::limpiar_cadena($_POST['producto_costo_edit']);
		$producto_precio = mainModel::limpiar_cadena($_POST['producto_precio_edit']);
		$producto_id = mainModel::limpiar_cadena($_POST['producto_id_edit']);

		if ($producto_codigo == "" || $producto_existencia == "" || $producto_descripcion == "" || $producto_costo == "" || $producto_precio == "") {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		}

			$consulta_codigo = productoModelo::validar_codigo_modelo($producto_codigo);
		$codigo = $consulta_codigo->fetch(PDO::FETCH_ASSOC);
		if($producto_codigo!= $codigo['producto_codigo']){
			if ($consulta_codigo->rowCount() == 1) {
				$alerta = [
					"Alerta" => "simple",
					"Titulo" => "Ocurrió un error inesperado",
					"Texto" => "El codigo del producto ya se encuentra en el sistema.",
					"Tipo" => "error"
				];
				echo json_encode($alerta);
				exit();
			}
		}
		


		$datos_producto_edit = [
			"Codigo" => $producto_codigo,
			"Descripcion" => $producto_descripcion,
			"Costo" => $producto_costo,
			"Precio" => $producto_precio,
			"Existencia" => $producto_existencia,
			"Id"=>$producto_id
		];

		$producto_editar = productoModelo::editar_producto_modelo($datos_producto_edit);

		if ($producto_editar->rowCount() == 1) {
			$alerta = [
				"Alerta" => "recargar",
				"Titulo" => "usuario registrado",
				"Texto" => "Los datos del usuario han sido actualizados con exito",
				"Tipo" => "success"
			];
		} else {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado, Actualizando",
				"Texto" => "No hemos podido actualizar el usuario",
				"Tipo" => "error"
			];
		}
		echo json_encode($alerta);
	}
}
