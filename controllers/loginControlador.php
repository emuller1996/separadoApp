<?php

if ($peticionAjax) {
    require_once "../models/loginModelo.php";
} else {
    require_once "./models/loginModelo.php";
}

class loginControlador extends loginModelo
{

    /** Controlador Login inicio de sesion */
    public function iniciar_sesion_controlador()
    {
        $usuario = mainModel::limpiar_cadena($_POST['usuario_log']);
        $clave = mainModel::limpiar_cadena($_POST['clave_log']);

        if ($usuario == "" && $clave == "") {
            echo '
            <script>
            Swal.fire({
                title: "Ocurrio un error inesperado",
                text: "No se ha llenado los campos requeridos",
                type: "error",
              });
              </script>
            ';
            exit();
        }
        $claveEn = mainModel::encryption($clave);

        $datos_login = [
            'usuario' => $usuario,
            'clave' => $claveEn
        ];

        $datos_cuenta = loginModelo::iniciar_sesion_modelo($datos_login);

        if ($datos_cuenta->rowCount() == 1) {
            $row = $datos_cuenta->fetch();

            session_start(['name' => 'SPM']);
            $_SESSION['id_spm'] = $row['usuario_id'];
            $_SESSION['nombre_spm'] = $row['usuario_nombre'];
            $_SESSION['apellido_spm'] = $row['usuario_apellido'];
            $_SESSION['usuario_spm'] = $row['usuario_usuario'];
            $_SESSION['token_spm'] = md5(uniqid(mt_rand(), true));


            return header("Location:" . SERVERURL . "home/");
        } else {
            echo '
            <script>
            Swal.fire({
                title: "Ocurrio un error inesperado",
                text: "El usuario o contraseñas son incorrectas",
                type: "error",
              });
              </script>
            ';
        }
    }
    /** fin contrlador */

    /** Controlador forzar_cierre_sesion_controlador */
    public function forzar_cierre_sesion_controlador()
    {
        session_unset();
        session_destroy();
        if (headers_sent()) {
            return "<script>  window.location.href='" . SERVERURL . "login/' </script>";
        } else {
            return header("Location:" . SERVERURL . "login/");
        }
    }/** fin controlador */


    public function cierre_sesion_controlador (){
        session_start(['name' => 'SPM']);
        $token = mainModel::decryption($_POST['token']);
        $usuario = mainModel::decryption($_POST['usuario']);

        if($token==$_SESSION['token_spm'] &&$usuario==$_SESSION['usuario_spm'] ){
            session_unset();
            session_destroy();
            $alerta = [
                'Alerta' => 'redireccionar',
                'URL' => SERVERURL."login/",
                
            ];
            

        }else{

            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"No se puedo cerrar la sesion en el sistema",
                "Tipo"=>"error"
            ];
            

        }   
        echo json_encode($alerta);
    
    }
}
