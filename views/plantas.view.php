<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Plantas</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button title="Agregar" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">
                        <i class="fas fa-plus"></i> Agregar Nueva Planta
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
                        <table id="example2" class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Planta</th>
                                    <th>Precio</th>
                                    <th>Existencia</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['precio'] ?></td>
                                        <td><?php echo $row['existencia'] ?></td>
                                        <td>
                                            <img src="upload/<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre'] ?>" title="<?php echo $row['nombre'] ?>" width="25px" height="25px">
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a title="Modificar Planta" data-toggle="modal" data-target="#EditModal" href="javascript:void(0);" onclick="document.getElementById('id').value = <?= $row['id'] ?>;document.getElementById('nombre').value = '<?= $row['nombre'] ?>';document.getElementById('precio').value = '<?= $row['precio'] ?>';document.getElementById('existencia').value = '<?= $row['existencia'] ?>';" class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i> Modificar
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a title="Eliminar Planta" data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_nombre').innerHTML = '<?= $row['nombre'] ?>';" class="btn btn-danger btn-sm borrar">
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
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nueva Planta</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=plantas" id="ingresar" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="add_nombre" id="add_nombre" class="form-control" placeholder="Nombre de la Planta" onkeypress="return validarTexto(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="text" name="add_precio" class="form-control" placeholder="Precio de la Planta" onkeypress="return validarDecimal(event)" required="required">
                    </div>
                    <div class="form-group">
                        <label>Existencia</label>
                        <input type="text" name="add_existencia" min="1" class="form-control" placeholder="Existencias de la Planta" onkeypress="return validarNumero(event)" required="required">
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" name="add_imagen" min="1" class="form-control" required="required" accept=".jpg, .jpeg, .png">
                    </div>

                    <input type="submit" name="ingresar_planta" Value="Registrar" class="btn btn-primary">

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
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="defaultModalLabel">Editar Planta</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=plantas" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" onkeypress="return validarTexto(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="text" name="precio" id="precio" class="form-control" onkeypress="return validarDecimal(event)" required="required">
                    </div>
                    <div class="form-group">
                        <label>Existencia</label>
                        <input type="text" name="existencia" id="existencia" class="form-control" onkeypress="return validarNumero(event)" required="required">
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" name="imagen" min="1" class="form-control" accept=".jpg, .jpeg, .png">
                    </div>

                    <input type="submit" name="modificar_planta" id="modificar_insumo" Value="Actualizar" class="btn btn-success">

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
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Planta</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=plantas" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">

                    <strong>
                        <p id="delete_nombre"></p>
                    </strong></label>


                    <div class="form-group">
                        <label class="mr-sm-2">¿Deseas Eliminar este Planta?</label>
                    </div>

                    <input type="submit" name="eliminar_planta" id="eliminar_insumo" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>