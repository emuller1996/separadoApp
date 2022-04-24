<div class="card o-hidden border-0 shadow-lg my-4">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

            <div class="col">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Nuevo Producto.</h1>
                    </div>
                    <form class="user FormularioAjax needs-validation" action="<?php echo SERVERURL ?>ajax/productoAjax.php" method="POST" data-form="save" autocomplete="off" novalidate>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="producto_codigo_reg" name="producto_codigo_reg" placeholder="Codigo" required>
                                <div class="invalid-feedback text-center">
                                    Campo Codigo es obligatorio
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="producto_existencia_reg" name="producto_existencia_reg" placeholder="Existencias" required>
                                <div class="invalid-feedback text-center">
                                    Campo Existencias es obligatorio
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="producto_descripcion_reg" name="producto_descripcion_reg" placeholder="Descripcion" required>
                            <div class="invalid-feedback text-center">
                                Campo Descripcion es obligatorio
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="producto_costo_reg" name="producto_costo_reg" placeholder="Costo" required>
                                <div class="invalid-feedback text-center">
                                    Campo Costo es obligatorio
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="producto_precio_reg" name="producto_precio_reg" placeholder="Precio" required>
                                <div class="invalid-feedback text-center">
                                    Campo Precio es obligatorio
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-google btn-user btn-block">
                            <i class="fas fa-save mr-2"></i>
                            Guardar
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>