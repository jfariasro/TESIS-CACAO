<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventario</h1>
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
                                    <th>Cantidad</th>
                                    <th>Fase</th>
                                    <th>Mortalidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['cantidad'] ?></td>
                                        <td><?php echo $row['fase'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <?php if ($row['idfase'] >= 2 && $row['idfase'] <= 5) : ?>
                                                    <a title="Agregar Mortalidad" data-toggle="modal" data-target="#EditModal" href="javascript:void(0);" onclick="document.getElementById('existencia').value = '<?= $row['cantidad'] ?>';document.getElementById('id').value = '<?= $row['id'] ?>';document.getElementById('idfase').value = '<?= $row['idfase'] ?>';" class="btn btn-success btn-sm">
                                                        <i class="fas fa-minus"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php echo ($row['idfase'] < 2) ? "<b class='text-danger'>Fase sin mortalidad</b>" : ""; ?>
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

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Mortalidad</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=planta-produccion" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="idfase" id="idfase" value="">

                    <div class="form-group">
                        <label>Cantidad Actual</label>
                        <input type="text" name="existencia" id="existencia" class="form-control" onkeypress="return validarNumero(event)" required="required" readonly>
                    </div>

                    <div class="form-group">
                        <label>Mortalidad</label>
                        <input type="text" name="mortalidad" id="mortalidad" class="form-control" onkeypress="return validarNumero(event)" required="required">
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" onkeypress="return validarTexto(event)" required="required">
                    </div>

                    <input type="submit" name="agregar_mortalidad" id="agregar_mortalidad" Value="Actualizar" class="btn btn-success">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>