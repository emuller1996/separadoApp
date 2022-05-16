<?php

if ($peticionAjax) {
    require_once "../models/empresaModelo.php";
} else {
    require_once "./models/empresaModelo.php";
}


class empresaControlador extends empresaModelo
{

    //**INSERTAR EMPRESA CONTROLADOR */

    public function insertar_empresa_controlador()
    {
        $razonSocial = mainModel::limpiar_cadena($_POST['empresa_razo_social_reg']);
        $nitEmpresa = mainModel::limpiar_cadena($_POST['empresa_nit_reg']);
        $telefonoEmpresa = mainModel::limpiar_cadena($_POST['empresa_telefono_reg']);
        $representanteEmpresa = mainModel::limpiar_cadena($_POST['empresa_representante_reg']);
        $direccionEmpresa = mainModel::limpiar_cadena($_POST['empresa_direccion_reg']);
        $departamentoEmpresa = mainModel::limpiar_cadena($_POST['empresa_departamento_reg']);
        $cuidadEmpresa = mainModel::limpiar_cadena($_POST['empresa_cuidad_reg']);
        $archivo = $_FILES['empresa_imagen_reg']['name'];
        $ruta='';




        //VALIDACION DE CAMPOS
        if (
            $razonSocial == "" ||
            $nitEmpresa == "" ||
            $telefonoEmpresa == "" ||
            $representanteEmpresa == "" ||
            $direccionEmpresa == "" ||
            $departamentoEmpresa == "" ||
            $cuidadEmpresa == ""
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





        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['empresa_imagen_reg']['type'];
            $tamano = $_FILES['empresa_imagen_reg']['size'];
            $temp = $_FILES['empresa_imagen_reg']['tmp_name'];
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Formato Incorrecto",
                    "Texto" => "la imagen que intenta subir no tiene los formatos requeridos",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                //Si la imagen es correcta en tamaño y tipo
                //Se intenta subir al servidor
                if (move_uploaded_file($temp, '../storage/empresa/' . $archivo)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod('../storage/empresa/' . $archivo, 0777);
                    //Mostramos el mensaje de que se ha subido co éxito
                    $ruta = 'storage/empresa/'.$archivo;
                    
                } else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Error Al Subir",
                        "Texto" => "la imagen que intenta subir no tiene los formatos requeridos",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                    
                }
            }
        }





        $datos_empresa = [
            'Razon_Social' => $razonSocial,
            'Nit' => $nitEmpresa,
            'Telefono' => $telefonoEmpresa,
            'Representante' => $representanteEmpresa,
            'Direccion' => $direccionEmpresa,
            'Cuidad' => $cuidadEmpresa,
            'Departamento' => $departamentoEmpresa,
            'Url' =>$ruta

        ];

        $empresa_insert = empresaModelo::insertar_empresa_modelo($datos_empresa);

        if ($empresa_insert->rowCount() == 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Empresa Registrada",
                "Texto" => "Los datos de la empresa se gan guardado con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "¡Erro! Empresa No Registrada",
                "Texto" => "ha Ocurrido un error inesperado al registrar los datos.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta); 
    }



    //DATOS EMPRESA 

    public function getEmpresa()
    {
        $sql = mainModel::conectar()->prepare(
            "SELECT * FROM empresa"
        );
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}
