<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Control Producción</h1>
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
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Planta</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>
                                    <th>Fase</th>
                                    <th>Estado</th>
                                    <th>Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['planta'] ?></td>
                                        <td><?php echo $row['fecha_inicio']; ?></td>
                                        <td><?php echo $row['cantidad'] ?></td>
                                        <td><?php echo (!$row['estado']) ? $row['fase'] : "Fases Finalizadas" ?></td>
                                        <td><?php echo (!$row['estado']) ? "En Proceso" : "Finalizado" ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm" title="Imprimir Detalle" target="_blank" href="reportes/reporte-produccion.php?codigo=<?php echo $row['id']; ?>" role="button">
                                                <i class="fas fa-file-pdf"></i><?php echo (!$row['estado']) ? "" : " Ver Detalle" ?>
                                            </a>
                                            <?php if (!$row['estado']) : ?>
                                                <a class="btn btn-primary btn-sm" title="Agregar Detalle P." target="_blank" href="panel.php?modulo=generar-produccion&codigoProduccion=<?php echo $row['id']; ?>" role="button">
                                                    <i class="fas fa-plus"></i>
                                                </a>

                                                <?php if ($row['idfase'] < 5) : ?>
                                                    <a title="Siguiente Fase" data-toggle="modal" data-target="#FaseModal" href="javascript:void(0);" onclick="document.getElementById('id').value = <?= $row['id'] ?>;document.getElementById('idfase').value = <?= $row['idfase'] ?>;document.getElementById('fase').innerHTML = '<?= $row['fase'] ?>';" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if ($row['idfase'] == 5) : ?>
                                                    <a title="Finalizar Produccion" data-toggle="modal" data-target="#ProduccionModal" href="javascript:void(0);" onclick="document.getElementById('id2').value = <?= $row['id'] ?>;document.getElementById('idfase2').value = <?= $row['idfase'] ?>;" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
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

<div class="modal fade" id="FaseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="defaultModalLabel">Siguiente Fase</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=control-produccion" method="POST">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="idfase" id="idfase" value="">

                    <p>Fase Actual -> <strong id="fase"></strong></p>

                    <div class="form-group">
                        <label class="mr-sm-2">¿Deseas Pasar a La Siguiente Fase?</label>
                    </div>

                    <input type="submit" name="siguiente_fase" id="siguiente_fase" Value="Aceptar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ProduccionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="defaultModalLabel">Finalizar</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=control-produccion" method="POST">
                    <input type="hidden" name="id2" id="id2" value="">
                    <input type="hidden" name="idfase2" id="idfase2" value="">

                    <div class="form-group">
                        <label class="mr-sm-2">¿Deseas finalizar la producción?</label>
                    </div>

                    <input type="submit" name="finalizar_produccion" id="finalizar_produccion" Value="Aceptar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>