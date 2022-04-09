<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Lista Usuarios.</h6>
    </div>
    <div class="card-body">

<?php 
$peticionAjax=false;
require_once "./controllers/usuarioControlador.php";
$ins_usuario_controlador = new usuarioControlador();

echo $ins_usuario_controlador->listar_usuario_controlador();


?>


        
    </div>
</div>