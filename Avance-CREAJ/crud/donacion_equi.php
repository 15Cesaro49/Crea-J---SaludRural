<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Donaciones de equipos médicos</h1>

   
    <br>  

<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">         
                        <table id="tablaHospitales" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Donador</th>
                                <th>Para</th>
                               <th>Fecha</th>
                                <th>Correo</th>                                
                                <th>Equipo</th>  
                                <th>cantidad</th>  
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <?php include'info/info-equipo.php' ?>     
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Aquí puedes colocar tu formulario de edición -->
                    <form action="bd/estado_equi.php" method="POST">
                    <input type="hidden" name="id_donacion" value="<?php echo $dat['id_donacion'] ?>">
                        <div class="form-group">
                            <label for="nuevoEstado">Nuevo Estado:</label>
                            <select id="nuevoEstado" name="estado" class="form-control">
                                <option value="aceptada">Aceptar</option>
                                <option value="rechazar">Rechazar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar -->
    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarModalLabel">Eliminar Estado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este estado?
                <form action="bd/eliminar_equi.php" method="POST">
                    <input type="hidden" name="id_donacion" value="<?php echo $dat['id_donacion'] ?>">
                    <!-- Puedes incluir otros elementos en el formulario si es necesario -->
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
      
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/estado.php"?>