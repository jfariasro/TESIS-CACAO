<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Panel de Control</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Primer conjunto de datos -->
            <div class="row">
                <div class="col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo '$' . $totalVentasUltimos7Dias ?? 0; ?></h3>
                            <p>Ventas en los últimos 7 días</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <a href="panel.php?modulo=ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $totalClientes ?? 0; ?></h3>
                            <p>Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <a href="panel.php?modulo=clientes" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo '$' . $totalVentasMesActual ?? 0; ?></h3>
                            <p>Total de Ventas en el Mes Actual</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="panel.php?modulo=ventas" class="small-box-footer">Nueva Venta <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo '$' . $totalComprasUltimos7Dias ?? 0; ?></h3>
                            <p>Compras en los últimos 7 días</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="panel.php?modulo=compras" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $totalProveedores ?? 0; ?></h3>
                            <p>Proveedores</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="panel.php?modulo=proveedores" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $totalTrabajadores ?? 0; ?></h3>
                            <p>Trabajadores</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="panel.php?modulo=trabajadores" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo '$' . $ultimoTotalCaja ?? 0; ?></h3>
                            <p>Flujo de Caja</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                        <a href="panel.php?modulo=caja" class="small-box-footer">Detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?php echo '$' . $totalPagoTrabajador ?? 0; ?></h3>
                            <p>Pago de Trabajador</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-hammer"></i>
                        </div>
                        <a href="panel.php?modulo=control-actividades" class="small-box-footer">Detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $totalProduccion; ?></h3>
                            <p>Total Producido</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-leaf"></i>
                        </div>
                        <a href="panel.php" class="small-box-footer">Detalles <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="container mt-2">
                <div class="row">
                    <!-- Primer gráfico -->
                    <div class="col-xl-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div id="chart_div" style="width: 100%; height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Segundo gráfico -->
                    <div class="col-xl-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div id="chart_div2" style="width: 100%; height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-2">
                <div class="row">
                    <!-- Primer gráfico -->
                    <div class="col-xl-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div id="chart_div3" style="width: 100%; height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Control Productivo -->
            <div class="container mt-2">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-success card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="text-center">Control Productivo</h2>
                                        <canvas id="myChart" style="width: 100%; height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script>
    $(document).ready(function() {
        Grafica(<?php echo json_encode($datosVentas); ?>, 'Ventas por mes', 'chart_div');
        Grafica(<?php echo json_encode($datosCompras); ?>, 'Compras por mes', 'chart_div2');
        Grafica(<?php echo json_encode($datosCostos); ?>, 'Costos de Producción', 'chart_div3');
        Graficar(<?php echo json_encode($datosSemaforo); ?>);
    });
</script>

<script src="js/graficos/venta.js"></script>