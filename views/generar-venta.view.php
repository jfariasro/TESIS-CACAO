<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Venta Generada</h1>
                    <?php if ($_SESSION['codigoVenta'] !== '') : ?>
                        <a href="panel.php?modulo=finalizar/finalizarVenta" title="Finalizar Venta" class="text-left m-2 btn btn-primary">
                            <i class="fas fa-check-circle"></i> Finalizar Venta
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6 text-right">
                    <button title="Agregar" type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                        <i class="fas fa-plus"></i> Agregar Nueva Venta
                    </button>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Planta</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($codigo)) :
                                    $total_venta = 0;
                                    $cod = '';
                                    $cli = '';
                                    $fecha = '';
                                    while ($row = mysqli_fetch_assoc($resVenta)) :
                                        $total_venta += $row['total'];
                                        $cod = $row['codigo'];
                                        $cli = $row['cliente'];
                                        $fecha = $row['fecha'];
                                ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['planta'] ?></td>
                                            <td><?php echo $row['cantidad'] ?></td>
                                            <td><?php echo $row['precio'] ?></td>
                                            <td><?php echo $row['total'] ?></td>
                                            <td>
                                                <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_codigo').value = <?= $row['codigo'] ?>;" title="Eliminar Venta" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    endwhile;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if ($_SESSION['codigoVenta'] !== '') : ?>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Total de Venta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $cod ?></td>
                                        <td><?php echo $cli ?></td>
                                        <td><?php echo date('d/m/Y H:i:s', strtotime($fecha)); ?></td>
                                        <td><?php echo $total_venta ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="agregar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nueva Venta</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-venta" id="ingresar" method="POST">
                    <div class="form-group">
                        <label for="idplanta" class="mr-sm-2">Planta:</label>
                        <select name="idplanta" id="idplanta" class="form-control mb-2 mr-sm-2" required>
                            <option value="">Seleccione una Planta para la Venta</option>
                            <?php while ($rowPlanta = mysqli_fetch_assoc($resPlanta)) : ?>
                                <option value="<?php echo $rowPlanta['id']; ?>"><?php echo $rowPlanta['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <?php if ($_SESSION['codigoVenta'] == '') : ?>
                        <div class="form-group">
                            <label for="idcliente" class="mr-sm-2">Cliente:</label>
                            <select name="idcliente" id="idcliente" class="form-control mb-2 mr-sm-2" required>
                                <option value="">Seleccione un Cliente para la Venta</option>
                                <?php while ($rowCliente = mysqli_fetch_assoc($resCliente)) : ?>
                                    <option value="<?php echo $rowCliente['id']; ?>"><?php echo $rowCliente['nombre']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="cantidad" class="mr-sm-2">Cantidad:</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Ingrese una Cantidad" id="cantidad" name="cantidad" min="1" onkeypress="return validarNumero(event)" required>
                    </div>

                    <div class="form-group">
                        <label for="precio" class="mr-sm-2">Precio:</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Ingrese el precio" id="precio" name="precio" onkeypress="return validarDecimal(event)" required>
                    </div>

                    <input type="submit" name="Guardar" Value="Registrar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Venta</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-venta" id="borrar" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                    <input type="hidden" name="delete_codigo" id="delete_codigo" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar esta venta?</label>
                    </div>

                    <input type="submit" name="delete_venta" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---fin modal Eliminar --->