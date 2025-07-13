<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Compras</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="panel.php?modulo=generar-compra" title="Generar Nueva Compra" type="button" class="btn btn-success">
                        <i class="fas fa-plus"></i> Generar Nueva Compra
                    </a>
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
                    <div class="table-responsive">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Factura</th>
                                        <th>Fecha</th>
                                        <th>Proveedor</th>
                                        <th>Total</th>
                                        <th>Detalle Compra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($res)) :
                                    ?>
                                        <tr>
                                            <td><?php echo $row['factura'] ?></td>
                                            <td><?php echo $row['fecha']; ?></td>
                                            <td><?php echo $row['proveedor'] ?></td>
                                            <td><?php echo $row['total'] ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-info" title="Imprimir Factura" target="_blank" href="reportes/reporte-compras.php?codigo=<?php echo $row['codigo']; ?>" role="button">
                                                    <i class="fas fa-file-pdf"></i> Imprimir Factura
                                                </a>
                                            </td>
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