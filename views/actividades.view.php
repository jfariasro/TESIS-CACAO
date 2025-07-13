<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Actividades</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button title="Agregar" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">
                        <i class="fas fa-plus"></i> Agregar Nueva Actividad
                    </button>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Tipo Actividad</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['tipoactividad'] ?></td>
                                        <td><?php echo $row['descripcion'] ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a title="Modificar Actividad" data-toggle="modal" data-target="#EditModal" href="javascript:void(0);" onclick="EditarActividad('<?php echo $row['id']; ?>', '<?php echo $row['nombre']; ?>', '<?php echo $row['idtipoactividades']; ?>', '<?php echo $row['descripcion']; ?>')" class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i> Modificar
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a title="Eliminar Actividad" data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_nombre').innerHTML = '<?= $row['nombre'] ?>';" class="btn btn-danger btn-sm borrar">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nueva Actividad</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=actividades" id="ingresar" method="POST">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="add_nombre" id="add_nombre" class="form-control" placeholder="Nombre de la Actividad" onkeypress="return validarTexto(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo Actividad:</label>
                        <select name="add_idtipoactividad" id="add_idtipoactividad" class="form-control" required>
                            <option value="">Seleccionar el Tipo de Actividad</option>
                            <?php while ($rowTipo = mysqli_fetch_assoc($resTipo)) : ?>
                                <option value="<?php echo $rowTipo['id']; ?>"><?php echo $rowTipo['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="add_descripcion" id="add_descripcion" class="form-control" placeholder="Descripción de la Actividad" required>
                    </div>

                    <input type="submit" name="ingresar_actividad" Value="Registrar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Editar Actividad</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=actividades" method="POST">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" onkeypress="return validarTexto(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo Actividad:</label>
                        <select name="idtipoactividad" id="idtipoactividad" class="form-control" required>
                            <option value="">Seleccionar el Tipo de Actividad</option>
                            <?php while ($rowTipoM = mysqli_fetch_assoc($resTipoM)) : ?>
                                <option value="<?php echo $rowTipoM['id']; ?>"><?php echo $rowTipoM['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                    </div>

                    <input type="submit" name="modificar_actividad" id="modificar_actividad" Value="Actualizar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Actividad</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=actividades" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">

                    <strong>
                        <p id="delete_nombre"></p>
                    </strong></label>


                    <div class="form-group">
                        <label class="mr-sm-2">¿Deseas Eliminar esta Actividad?</label>
                    </div>

                    <input type="submit" name="eliminar_actividad" id="eliminar_actividad" Value="Eliminar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function EditarActividad(id, nombre, idtipoactividad, descripcion) {
        document.getElementById('id').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('descripcion').value = descripcion;

        var selector = document.getElementById('idtipoactividad');

        for (var i = 0; i <= selector.options.length; i++) {
            if (selector.options[i].value === idtipoactividad) {
                selector.options[i].selected = true;
                break;
            }
        }
    }
</script>