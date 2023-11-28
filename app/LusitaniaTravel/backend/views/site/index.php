<?php

/** @var yii\web\View $this */

$this->title = 'Dashboard';
?>
<div class="site-index">
    <!-- Conteúdo principal -->
    <section class="content">
        <div class="container-fluid">
            <!-- Caixas pequenas (Estatísticas) -->
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Novas Reservas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Coluna 2 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>
                            <p>Taxa de Reservas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Coluna 3 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>Novos Utilizadores</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Coluna 4 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Novos visitantes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="row">
                <section class="col-lg-7 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Reservas
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Área</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Gráfico de Área -->
                                <div class="chart tab-pane active" id="revenue-chart">
                                    <canvas id="revenue-chart-canvas"></canvas>
                                </div>

                                <!-- Gráfico Rosquinha -->
                                <div class="chart tab-pane" id="sales-chart">
                                    <canvas id="sales-chart-canvas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
