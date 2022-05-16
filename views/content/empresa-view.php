<?php
require_once "./controllers/empresaControlador.php";
$ins_empresa = new empresaControlador();
$datos_empresa = $ins_empresa->getEmpresa();
?>


<div class="card border-left-secondary shadow h-100">

    <div class="card-body ">
        <div class="text-center">
        <div class="text-center block mb-2">Imagen de la Empresa</div>
            
                <img 
                class="figure-img img-fluid rounded" 
                src="<?php echo SERVERURL.$datos_empresa['empresa_url_imagen'] ?>" 
                alt="NO IMAGEN" 
                style="width: 12rem; height: 12rem;"
                srcset="">
            
        </div>

        <div class="text-center block mt-4">Datos de la Empresa</div>
        <hr>
        <form action="<?php echo SERVERURL ?>ajax/empresaAjax.php" method="POST" class="FormularioAjax text-right needs-validation" data-form="save" enctype="multipart/form-data" autocomplete="off" novalidate>
            <div class="form-group row">
                <input type="hidden" 
                    name="id_empresa_edit" 
                    value="<?php  if($datos_empresa) echo $datos_empresa['empresa_id'] ?>">
                <label for="input_razon_social" class="col-sm-3 col-form-label">Razon Social</label>
                <div class="col-sm-9">
                    <input type="text" 
                        class="form-control" 
                        id="empresa_razo_social_reg"
                        name="empresa_razo_social_reg" 
                        value="<?php  if($datos_empresa) echo $datos_empresa['empresa_razon_social'] ?>"
                        required>
                    <div class="invalid-feedback text-center">
                        La Razon Social es obligatoria.
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="input_nit_empresa" class="col-sm-3 col-form-label">Nit Empresa</label>
                <div class="col-sm-9">
                    <input type="text" 
                    class="form-control" 
                    id="empresa_nit_reg" 
                    name="empresa_nit_reg"
                    value="<?php  if($datos_empresa) echo $datos_empresa['empresa_nit'] ?>"
                    required>
                    <div class="invalid-feedback text-center">
                        El Nit es obligatorio
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="input_nit_empresa" class="col-sm-3 col-form-label">Telefono </label>
                <div class="col-sm-9">
                    <input type="text" 
                    class="form-control" 
                    id="empresa_telefono_reg" 
                    name="empresa_telefono_reg" 
                    value="<?php  if($datos_empresa) echo $datos_empresa['empresa_telefono'] ?>"
                    required>
                    <div class="invalid-feedback text-center">
                        El Telefono es obligatorio
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="input_nit_empresa" class="col-sm-3 col-form-label">Representante </label>
                <div class="col-sm-9">
                    <input type="text" 
                    class="form-control" 
                    id="empresa_representante_reg" 
                    name="empresa_representante_reg" 
                    value="<?php  if($datos_empresa) echo $datos_empresa['empresa_representante'] ?>"
                    required>
                    <div class="invalid-feedback text-center">
                        El Representante es obligatorio
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="input_nit_empresa" class="col-sm-3 col-form-label">Direccion </label>
                <div class="col-sm-9">
                    <input type="text" 
                    class="form-control" 
                    id="empresa_direccion_reg" 
                    name="empresa_direccion_reg" 
                    value="<?php  if($datos_empresa) echo $datos_empresa['empresa_direccion'] ?>"
                    required>
                    <div class="invalid-feedback text-center">
                        La Direccion es obligatoria.
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="input_nit_empresa" class="col-sm-3 col-form-label">Departamento </label>
                <div class="col-sm-9">
                    <input type="text" 
                    class="form-control" 
                    id="empresa_departamento_reg" 
                    name="empresa_departamento_reg" 
                    value="<?php  if($datos_empresa) echo $datos_empresa['empresa_departamento'] ?>"
                    required>
                    <div class="invalid-feedback text-center">
                        El Departamento es obligatorio
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="input_nit_empresa" class="col-sm-3 col-form-label">Cuidad </label>
                <div class="col-sm-9">
                    <input type="text" 
                    class="form-control" 
                    id="empresa_cuidad_reg" 
                    name="empresa_cuidad_reg" 
                    value="<?php  if($datos_empresa) echo $datos_empresa['empresa_cuidad'] ?>"
                    required>
                    <div class="invalid-feedback text-center">
                        La Cuidad es obligatoria.
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="input_nit_empresa" class="col-sm-3 col-form-label">Imagen </label>
                <div class="col-sm-9">
                    <input type="file" 
                    class="form-control-file" 
                    id="empresa_imagen_reg" 
                    name="empresa_imagen_reg" 
                    
                    required>
                    <div class="invalid-feedback text-center">
                        La Imagen es obligatoria.
                    </div>
                </div>
            </div>
            <div class="form-group row text-center">
                <div class="col">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>


    </div>
</div>


<?php require_once "./views/include/validation.php"; ?>