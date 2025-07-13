<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h1 class="mb-2">Generar Nueva Compra</h1>
                    <?php if ($_SESSION['codigoCompra'] !== '') : ?>
                        <button title="Finalizar Compra" type="button" class="btn btn-primary" data-toggle="modal" data-target="#EndModal" onclick="document.getElementById('end_codigo').value = <?= $codigo ?>;">
                            <i class="fas fa-check-circle"></i> Finalizar Compra
                        </button>
                    <?php endif; ?>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-10">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-5">
                            <h2 class="mb-4 text-center">Formulario de Compras</h2>
                            <form action="panel.php?modulo=generar-compra" id="ingresar" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="proveedor">Proveedor</label>
                                        <select class="form-control" id="idproveedor" name="idproveedor" required <?php echo ($_SESSION['codigoCompra'] !== '') ? 'disabled' : '' ?>>
                                            <option value="">Seleccione un Proveedor para la Compra</option>
                                            <?php while ($rowProveedor = mysqli_fetch_assoc($resProveedor)) : ?>
                                                <option value="<?php echo $rowProveedor['id']; ?>" <?php echo (isset($idproveedor) && $rowProveedor['id'] == $idproveedor) ? 'selected' : '' ?>><?php echo $rowProveedor['nombre']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="insumo">Insumo</label>
                                        <select class="form-control" id="idinsumo" name="idinsumo" required>
                                            <option value="">Seleccione un Insumo para la Compra</option>
                                            <?php while ($rowInsumo = mysqli_fetch_assoc($resInsumo)) : ?>
                                                <option value="<?php echo $rowInsumo['id']; ?>"><?php echo $rowInsumo['nombre']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="cantidad" class="mr-sm-2">Cantidad:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Ingrese una Cantidad" id="cantidad" name="cantidad" min="1" onkeypress="return validarNumero(event)" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="precio" class="mr-sm-2">Precio:</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Ingrese el precio" id="precio" name="precio" onkeypress="return validarDecimal(event)" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="Guardar">Registrar Compra</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-1"></div>
        </div>
        <?php if ($_SESSION['codigoCompra'] !== '') : ?>
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h2>Datos de Compra</h2>
                </div>
                <div class="col-xl-1"></div>
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Proveedor</th>
                                        <th>Total de Compra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $rowDatos['codigo'] ?></td>
                                        <td><?php echo $rowDatos['proveedor'] ?></td>
                                        <td><?php echo $rowDatos['total'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1"></div>
            </div>
        <?php endif; ?>
        <div class="row mb-2">
            <div class="col-sm-12 text-center">
                <h2>Listado de Compra Generada</h2>
            </div>
            <div class="col-xl-1"></div>
            <div class="col-xl-10">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Insumo</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($codigo)) :
                                    $total_compra = 0;
                                    $cod = '';
                                    $prov = '';
                                    while ($row = mysqli_fetch_assoc($resCompra)) :
                                        $total_compra += $row['total'];
                                        $cod = $row['codigo'];
                                        $prov = $row['proveedor'];
                                ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['insumo'] ?></td>
                                            <td><?php echo $row['cantidad'] ?></td>
                                            <td><?php echo $row['precio'] ?></td>
                                            <td><?php echo $row['total'] ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <a title="Modificar Compra" data-toggle="modal" data-target="#EditModal" href="javascript:void(0);" onclick="document.getElementById('id').value = <?= $row['id'] ?>;document.getElementById('edit_cantidad').value = '<?= $row['cantidad'] ?>';" class="btn btn-success btn-sm">
                                                            <i class="fas fa-edit"></i> Modificar
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_codigo').value = <?= $row['codigo'] ?>;" title="Eliminar Compra" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </a>
                                                    </div>
                                                </div>
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
            </div>
            <div class="col-xl-1"></div>
        </div>
    </section>
</div>

<div class="modal fade" id="agregar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nueva Compra</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-compra" id="ingresar" method="POST">
                    <input type="hidden" name="idinsumo" id="idinsumo">
                    <?php if ($_SESSION['codigoCompra'] == '') : ?>
                        <div class="form-group">
                            <label for="idproveedor" class="mr-sm-2">Proveedor:</label>
                            <select name="idproveedor" id="idproveedor" class="form-control mb-2 mr-sm-2" required>
                                <option value="">Seleccione un Proveedor para la Compra</option>
                                <?php while ($rowProveedor = mysqli_fetch_assoc($resProveedor)) : ?>
                                    <option value="<?php echo $rowProveedor['id']; ?>"><?php echo $rowProveedor['nombre']; ?></option>
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

<div class="modal fade" id="EndModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Factura</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=generar-compra" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="end_codigo" id="end_codigo">

                    <div class="form-group">
                        <label>Número de Factura:</label>
                        <input type="text" name="end_factura" id="end_factura" class="form-control" required="required">
                    </div>

                    <input type="submit" name="agregar_factura" id="agregar_factura" Value="Finalizar" class="btn btn-info">

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
                <h4 class="modal-title" id="defaultModalLabel">Editar Cantidad del Insumo</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=generar-compra" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group">
                        <label>Cantidad</label>
                        <input type="text" name="edit_cantidad" id="edit_cantidad" class="form-control" onkeypress="return validarNumero(event)" required="required">
                    </div>

                    <input type="submit" name="modificar_compra" id="modificar_compra" Value="Actualizar" class="btn btn-success">

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
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Compra</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-compra" id="borrar" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                    <input type="hidden" name="delete_codigo" id="delete_codigo" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar esta compra?</label>
                    </div>

                    <input type="submit" name="delete_compra" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---fin modal Eliminar --->