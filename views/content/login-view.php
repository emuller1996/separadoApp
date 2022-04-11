<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Bienvenido a SeparadosAPP</h1>
                            </div>
                            <form method="POST" class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="usuario_log" name="usuario_log" aria-describedby="emailHelp" placeholder="Ingrese aqui su usuario...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="clave_log" name="clave_log" placeholder="Ingrese aqui la clave">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Recordarme </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    INGRESAR
                                </button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
    $peticionAjax=false;
    require_once "./controllers/loginControlador.php";
    $ins_login = new loginControlador();
    echo $ins_login->iniciar_sesion_controlador();
} else {
}

?>