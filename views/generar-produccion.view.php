<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php if (isset($fasenombre)) : ?>
                    <?php endif; ?>
                    <h1><?php echo (isset($fasenombre)) ? $fasenombre : "Llenado de Fundas" ?></h1>
                    <?php if ($_SESSION['codigoActividadProduccion'] !== '') : ?>
                        <a href="panel.php?modulo=finalizar/finalizarActividadProduccion" title="Finalizar Actividad" class="text-left m-2 btn btn-primary">
                            <i class="fas fa-check-circle"></i> Finalizar Actividad P.
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-5">
                            <button title="Agregar Insumo" type="button" class="btn btn-success" data-toggle="modal" data-target="#AddModal">
                                <i class="fas fa-plus"></i> Agregar Insumo
                            </button>
                        </div>
                        <div class="col-xl-5">
                            <button title="Agregar Trabajador" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModalTrabajador">
                                <i class="fas fa-plus"></i> Agregar Trabajador
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
            <div class="col-md-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Planta</th>
                                    <th>Actividad</th>
                                    <th>Tipo Actividad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($_SESSION['codigoActividadProduccion'] !== '') : ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y H:i:s', strtotime($gestion_actividad['fecha'])); ?></td>
                                        <td><?php echo $gestion_actividad['planta']; ?></td>
                                        <td><?php echo $gestion_actividad['actividad']; ?></td>
                                        <td><?php echo $gestion_actividad['tipo']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Insumo</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($resRecurso)) : ?>
                                    <tr>
                                        <td><?php echo $row['insumo']; ?></td>
                                        <td><?php echo $row['cantidad']; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a title="Modificar Cantidad" data-toggle="modal" data-target="#EditModal1" href="javascript:void(0);" onclick="document.getElementById('edit_id1').value = <?= $row['id'] ?>;document.getElementById('id1').value = <?= $row['idinsumo'] ?>;document.getElementById('edit_cantidad').value = '<?= $row['cantidad'] ?>';" class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" data-target="#DeleteModal1" href="javascript:void(0);" onclick="document.getElementById('delete_id1').value = <?= $row['id'] ?>;document.getElementById('delete_codigo').value = <?= $row['idgestionactividad'] ?>;" title="Eliminar Recurso" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
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
            <div class="col-md-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Trabajador</th>
                                    <th>Costo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($resTrabajadorAc)) : ?>
                                    <tr>
                                        <td><?php echo $row['trabajador']; ?></td>
                                        <td><?php echo $row['costo']; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a title="Modificar Costo" data-toggle="modal" data-target="#EditModal2" href="javascript:void(0);" onclick="document.getElementById('edit_id2').value = <?= $row['id'] ?>;document.getElementById('id2').value = <?= $row['idtrabajador'] ?>;document.getElementById('edit_costo').value = '<?= $row['costo'] ?>';" class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" data-target="#DeleteModal2" href="javascript:void(0);" onclick="document.getElementById('delete_id2').value = <?= $row['id'] ?>;document.getElementById('delete_codigo2').value = <?= $row['idgestionactividad'] ?>;" title="Eliminar Trabajador" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
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
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Insumo</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-produccion" method="POST">
                    <?php if ($_SESSION['codigoActividadProduccion'] == '') : ?>
                        <div class="form-group">
                            <label for="idactividad">Actividades</label>
                            <select class="form-control" id="idactividad" name="idactividad" required>
                                <option value="">Seleccione una Actividad</option>
                                <?php while ($rowActividad = mysqli_fetch_assoc($resActividad1)) : ?>
                                    <option value="<?php echo $rowActividad['id']; ?>"><?php echo $rowActividad['nombre']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <?php if ($_SESSION['codigoProduccion'] == '') : ?>
                            <div class="form-group">
                                <label for="idplanta">Plantas</label>
                                <select class="form-control" id="idplanta" name="idplanta" required>
                                    <option value="">Seleccione una Planta</option>
                                    <?php while ($rowPlanta = mysqli_fetch_assoc($resPlanta1)) : ?>
                                        <option value="<?php echo $rowPlanta['id']; ?>"><?php echo $rowPlanta['nombre']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cantidad_planta" class="mr-sm-2">Cantidad de Plantas:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Ingrese una Cantidad de Plantas" id="cantidad_planta" name="cantidad_planta" min="1" onkeypress="return validarNumero(event)" required>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="idinsumo">Insumo</label>
                        <select class="form-control" id="idinsumo" name="idinsumo" required>
                            <option value="">Seleccione un Insumo para la Actividad</option>
                            <?php while ($rowInsumo = mysqli_fetch_assoc($resInsumo)) : ?>
                                <option value="<?php echo $rowInsumo['id']; ?>"><?php echo $rowInsumo['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad" class="mr-sm-2">Cantidad:</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Ingrese una Cantidad" id="cantidad" name="cantidad" min="1" onkeypress="return validarNumero(event)" required>
                    </div>

                    <input type="submit" name="agregar_insumo" Value="Registrar Insumo" class="btn btn-success">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AddModalTrabajador" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Trabajador</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-produccion" id="ingresar_salida" method="POST">
                    <?php if ($_SESSION['codigoActividadProduccion'] == '') : ?>
                        <div class="form-group">
                            <label for="idactividad">Actividades</label>
                            <select class="form-control" id="idactividad" name="idactividad" required>
                                <option value="">Seleccione una Actividad</option>
                                <?php while ($rowActividad = mysqli_fetch_assoc($resActividad2)) : ?>
                                    <option value="<?php echo $rowActividad['id']; ?>"><?php echo $rowActividad['nombre']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <?php if ($_SESSION['codigoProduccion'] == '') : ?>
                            <div class="form-group">
                                <label for="idplanta">Plantas</label>
                                <select class="form-control" id="idplanta" name="idplanta" required>
                                    <option value="">Seleccione una Planta</option>
                                    <?php while ($rowPlanta = mysqli_fetch_assoc($resPlanta2)) : ?>
                                        <option value="<?php echo $rowPlanta['id']; ?>"><?php echo $rowPlanta['nombre']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cantidad_planta" class="mr-sm-2">Cantidad de Plantas:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Ingrese una Cantidad de Plantas" id="cantidad_planta" name="cantidad_planta" min="1" onkeypress="return validarNumero(event)" required>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="idtrabajador">Trabajador</label>
                        <select class="form-control" id="idtrabajador" name="idtrabajador" required>
                            <option value="">Seleccione un Trabajador para la Actividad</option>
                            <?php while ($rowTrabajador = mysqli_fetch_assoc($resTrabajador)) : ?>
                                <option value="<?php echo $rowTrabajador['id']; ?>"><?php echo $rowTrabajador['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="costo" class="mr-sm-2">Costo:</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Ingrese el costo" id="costo" name="costo" onkeypress="return validarDecimal(event)" required>
                    </div>

                    <input type="submit" name="agregar_trabajador" Value="Registrar Trabajador" class="btn btn-primary">

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

<div class="modal fade" id="EditModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="defaultModalLabel">Editar Cantidad del Insumo</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=generar-produccion" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id1" id="edit_id1" value="">
                    <input type="hidden" name="id1" id="id1" value="">

                    <div class="form-group">
                        <label>Cantidad</label>
                        <input type="text" name="edit_cantidad" id="edit_cantidad" class="form-control" onkeypress="return validarNumero(event)" required="required">
                    </div>

                    <input type="submit" name="modificar_cantidad" id="modificar_cantidad" Value="Actualizar" class="btn btn-success">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar -->
<div class="modal fade" id="DeleteModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Insumo</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-produccion" id="borrar" method="POST">
                    <input type="hidden" name="delete_id1" id="delete_id1" value="">
                    <input type="hidden" name="delete_codigo" id="delete_codigo" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar?</label>
                    </div>

                    <input type="submit" name="delete_recurso" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---fin modal Eliminar --->

<div class="modal fade" id="EditModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="defaultModalLabel">Editar Costo</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=generar-produccion" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id2" id="edit_id2" value="">
                    <input type="hidden" name="id2" id="id2" value="">

                    <div class="form-group">
                        <label>Costo</label>
                        <input type="text" name="edit_costo" id="edit_costo" class="form-control" onkeypress="return validarDecimal(event)" required="required">
                    </div>

                    <input type="submit" name="modificar_costo" id="modificar_costo" Value="Actualizar" class="btn btn-success">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar -->
<div class="modal fade" id="DeleteModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Insumo</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-produccion" id="borrar" method="POST">
                    <input type="hidden" name="delete_id2" id="delete_id2" value="">
                    <input type="hidden" name="delete_codigo2" id="delete_codigo2" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar?</label>
                    </div>

                    <input type="submit" name="delete_trabajador" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---fin modal Eliminar --->