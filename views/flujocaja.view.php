<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Flujo de Caja</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="row">
                        <div class="col-xl 2"></div>
                        <div class="col-xl-4">
                            <button title="Entrada" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">
                                <i class="fas fa-plus"></i> Agregar Entrada
                            </button>
                        </div>
                        <div class="col-xl-4">
                            <button title="Salida" type="button" class="btn btn-danger" data-toggle="modal" data-target="#AddModalSalida">
                                <i class="fas fa-minus"></i> Agregar Salida
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Movimiento</th>
                                        <th>Fecha</th>
                                        <th>Entrada</th>
                                        <th>Salida</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($res)) :
                                    ?>
                                        <tr>
                                            <td><?php echo $row['movimiento']; ?></td>
                                            <td><?php echo date('d/m/Y H:i:s', strtotime($row['fecha'])); ?></td>
                                            <td><?php echo $row['entrada']; ?></td>
                                            <td><?php echo $row['salida']; ?></td>
                                            <td><?php echo $row['parcial']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
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
                <form action="panel.php?modulo=flujocaja" id="ingresar" method="POST">
                    <div class="form-group">
                        <label>Movimiento:</label>
                        <select name="add_idmovimientos" id="add_idmovimientos" class="form-control" required>
                            <option value="">Seleccionar el Movimiento</option>
                            <?php while ($row = mysqli_fetch_assoc($resMovimiento)) : ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['movimiento']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Entrada</label>
                        <input type="text" name="add_entrada" class="form-control" placeholder="Entrada del Flujo de Caja" onkeypress="return validarDecimal(event)" required="required">
                    </div>

                    <input type="submit" name="agregar_entrada" Value="Registrar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AddModalSalida" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nuevo Movimiento</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=flujocaja" id="ingresar_salida" method="POST">
                    <div class="form-group">
                        <label>Movimiento:</label>
                        <select name="add_idmovimientos" id="add_idmovimientos" class="form-control" required>
                            <option value="">Seleccionar el Movimiento</option>
                            <?php while ($row = mysqli_fetch_assoc($resMovimiento2)) : ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['movimiento']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Entrada</label>
                        <input type="text" name="add_salida" class="form-control" placeholder="Entrada del Flujo de Caja" onkeypress="return validarDecimal(event)" required="required">
                    </div>

                    <input type="submit" name="agregar_salida" Value="Registrar" class="btn btn-danger">

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