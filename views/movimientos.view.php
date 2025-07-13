<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Movimientos</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button title="Agregar" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">
                        <i class="fas fa-plus"></i> Agregar Nuevo Movimiento.
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
                                    <th>Movimiento</th>
                                    <th>Descripción</th>
                                    <th>Tipo M.</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['movimiento'] ?></td>
                                        <td><?php echo $row['descripcion'] ?></td>
                                        <td><?php echo $row['tipo'] ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a title="Modificar Movimiento" data-toggle="modal" data-target="#EditModal" href="javascript:void(0);" onclick="EditarMovimiento('<?php echo $row['id']; ?>', '<?php echo $row['movimiento']; ?>', '<?php echo $row['idtipo']; ?>', '<?php echo $row['descripcion']; ?>')" class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i> Modificar
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a title="Eliminar Movimiento" data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_nombre').innerHTML = '<?= $row['movimiento'] ?>';" class="btn btn-danger btn-sm borrar">
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
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nuevo Movimiento</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=movimientos" id="ingresar" method="POST">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="add_nombre" id="add_nombre" class="form-control" placeholder="Nombre del Movimiento" onkeypress="return validarTexto(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="add_descripcion" id="add_descripcion" class="form-control" placeholder="Descripción del Movimiento" onkeypress="return validarTexto(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Movimiento:</label>
                        <select name="add_idtipo" id="add_idtipo" class="form-control" required>
                            <option value="">Seleccionar el Tipo de Movimiento</option>
                            <?php while ($rowTipo = mysqli_fetch_assoc($resTipo1)) : ?>
                                <option value="<?php echo $rowTipo['id']; ?>"><?php echo $rowTipo['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <input type="submit" name="ingresar_movimiento" Value="Registrar" class="btn btn-primary">

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
                <h4 class="modal-title" id="defaultModalLabel">Editar Movimiento</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=movimientos" method="POST">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" onkeypress="return validarTexto(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" onkeypress="return validarTexto(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Movimiento:</label>
                        <select name="idtipo" id="idtipo" class="form-control" required>
                            <option value="">Seleccionar el Tipo de Movimiento</option>
                            <?php while ($rowTipo = mysqli_fetch_assoc($resTipo2)) : ?>
                                <option value="<?php echo $rowTipo['id']; ?>"><?php echo $rowTipo['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <input type="submit" name="modificar_movimiento" id="modificar_movimiento" Value="Actualizar" class="btn btn-primary">

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
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Movimiento</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=movimientos" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">

                    <strong>
                        <p id="delete_nombre"></p>
                    </strong></label>


                    <div class="form-group">
                        <label class="mr-sm-2">¿Deseas Eliminar este Movimiento?</label>
                    </div>

                    <input type="submit" name="eliminar_movimiento" id="eliminar_movimiento" Value="Eliminar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function EditarMovimiento(id, nombre, idtipo, descripcion) {
        document.getElementById('id').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('descripcion').value = descripcion;

        var selector = document.getElementById('idtipo');

        for (var i = 0; i <= selector.options.length; i++) {
            if (selector.options[i].value === idtipo) {
                selector.options[i].selected = true;
                break;
            }
        }
    }
</script>