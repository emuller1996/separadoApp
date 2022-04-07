<div class="card o-hidden border-0 shadow-lg my-4">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            
            <div class="col">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Nuevo Usuario</h1>
                    </div>
                    <form class="user FormularioAjax" action="POST" data-form="save" autocomplete="off" >
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="Nombre" placeholder="Nombre">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="Apellido" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-google btn-user btn-block">
                                Guardar
                        </button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>