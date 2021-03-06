<?php

if ($peticionAjax) {
	require_once "../models/usuarioModelo.php";
} else {
	require_once "./models/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{

	/** Controlador agregar usuario */
	public function insertar_usuario_controlador()
	{
		$usuario_nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_reg']);
		$usuario_apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_reg']);
		$usuario_email = mainModel::limpiar_cadena($_POST['usuario_email_reg']);
		$usuario_usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_reg']);
		$usuario_pass_1 = mainModel::limpiar_cadena($_POST['usuario_pass_reg_1']);
		$usuario_pass_2 = mainModel::limpiar_cadena($_POST['usuario_pass_reg_2']);
		$usuario_telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_reg']);


		/**Validar Campos */
		if ($usuario_nombre == "" || $usuario_apellido == "" || $usuario_email == "" || $usuario_usuario == "" || $usuario_pass_1 == "" || $usuario_pass_2 == "" || $usuario_telefono == "") {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		}

		/*== Comprobando claves ==*/
		if ($usuario_pass_1 != $usuario_pass_2) {
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "Las claves que acaba de ingresar no coinciden",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
		} else {
			$clave = mainModel::encryption($usuario_pass_1);
		}

		$datos_usuario_reg = [
			"Nombre" => $usuario_nombre,
			"Apellido" => $usuario_apellido,
			"Usuario" => $usuario_usuario,
			"Clave" => $clave,
			"Email" => $usuario_email,
			"Telefono" => $usuario_telefono
		];

		$agregar_usuario = usuarioModelo::insertar_usuario_modelo($datos_usuario_reg);


		if ($agregar_usuario->rowCount() == 1) {
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


	public function listar_usuario_controlador()
	{

		$consulta = "SELECT * FROM `usuarios`";
		$conexion = mainModel::conectar();
		$datos = $conexion->query($consulta);
		$datos = $datos->fetchAll();

		$total = $conexion->query('SELECT FOUND_ROWS()');
		$total = (int) $total->fetchColumn();


		$tabla = "";

		$tabla .= '
			<div class="table-responsive">
            <table class="table-hover table-striped bg-light rounded border" id="data-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Usuarios</th>
                        <th>Correos Electrónicos</th>

                        <th>Telefonos</th>
                        <th>Estados</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>';

		if ($total >= 1) {
			foreach ($datos as $row) {
				$tabla .= '<tr>
				<td>' . $row['usuario_id'] . '</td>
				<td>' . $row['usuario_nombre'] . ' </td>
				<td>' . $row['usuario_apellido'] . ' </td>
				<td>' . $row['usuario_usuario'] . '</td>
				<td>' . $row['usuario_email'] . '</td>

				<td>' . $row['usuario_telefono'] . '</td>
				<td>
					<a class="btn btn-success rounded-pill">
					' . $row['usuario_estado'] . '

					</a>
				</td>
				<td>
					<div class="btn-group">
						<a href="'.SERVERURL.'usuario-editar/'.mainModel::encryption($row['usuario_id']) .'" class="btn btn-warning"><i class="fas fa-edit"></i></a>
						<a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
					</div>
				</td>
			</tr>';
			}
		} else {
			$tabla .= '<tr><td colspan="8">
					No hay Registros				
				</td></tr>';
		}


		$tabla .= '</tbody>
            </table>
        </div>';

		return $tabla;
	}

	public function get_usuario_controlador($id){
		$idUser =  mainModel::limpiar_cadena($id);
		$idUser =  mainModel::decryption($idUser);
		$sql = usuarioModelo::get_usuario_model($idUser);
		$usuarioEdit= $sql->fetch(PDO::FETCH_ASSOC);
		return $usuarioEdit;
	}
}
