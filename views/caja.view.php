<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Caja</h1>
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
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th>Total</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y H:i:s', strtotime($row['fecha_inicio'])); ?></td>
                                        <td><?php echo date('d/m/Y H:i:s', strtotime($row['fecha_fin'])); ?></td>
                                        <td><?php echo ($row['estado'] == 1) ? 'Cerrado' : 'Abierto'; ?></td>
                                        <td><?php echo $row['total']; ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-info" title="Imprimir Detalles" target="_blank" href="reportes/reporte-caja.php?codigo=<?php echo $row['id']; ?>" role="button">
                                                <i class="fas fa-file-pdf"></i> Imprimir Detalles
                                            </a>
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