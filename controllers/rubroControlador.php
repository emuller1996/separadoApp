<?php 
if ($peticionAjax) {
	require_once "../models/rubroModelo.php";
} else {
	require_once "./models/rubroModelo.php";
}

class rubroControlador extends rubroModelo {

    /**Insertar Rubro Controlador */
    public function insertar_rubro_controlador(){
        $rubro_nombre = mainModel:: limpiar_cadena($_POST['rubro_nombre_reg']);
        $rubro_descripcion = mainModel:: limpiar_cadena($_POST['rubro_descripcion_reg']);

        /**Validacion de Campos */

        if($rubro_descripcion=="" || $rubro_nombre==""){
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrió un error inesperado",
				"Texto" => "No has llenado todos los campos que son obligatorios",
				"Tipo" => "error"
			];
			echo json_encode($alerta);
			exit();
        }

        $datos_rubro_ins = [
            'Nombre' => $rubro_nombre,
            'Descripcion' =>$rubro_descripcion
        ];

        $rubro_insertar = rubroModelo::insertar_rubro_modelo($datos_rubro_ins);


        if($rubro_insertar->rowCount()==1){
            $alerta = [
				"Alerta" => "recargar",
				"Titulo" => "Rubro registrado",
				"Texto" => "Los datos del rubro se han registrado con exito en la base da datos.",
				"Tipo" => "success"
			];
            
        }else{
            $alerta = [
				"Alerta" => "simple",
				"Titulo" => "Error al Registro.",
				"Texto" => "no se ha podido realizar el registro en la base de datos",
				"Tipo" => "error"
			];
            

        }

        echo json_encode($alerta);

    }


    /**Listar Rubro */

    public function rubro_all(){
        $sql = mainModel::conectar()->prepare("SELECT * FROM rubros");
        $sql->execute();
        $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $sql;
    }



}


?>

