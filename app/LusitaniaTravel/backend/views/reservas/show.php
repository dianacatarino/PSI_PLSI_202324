<?php

use yii\bootstrap5\Html;

$this->title = 'Detalhes da Reserva';
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="col-sm-6">
    <p>
        <?= Html::a('Voltar', ['reservas/index'], ['class' => 'btn btn-secondary']) ?>
    </p>
</div>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Reserva</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Check-in</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($reserva->checkin) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Check-out</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($reserva->checkout) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Nº Pessoas</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($reserva->numeroclientes) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Nº Quartos</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($reserva->numeroquartos) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Preço por noite</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($reserva->valor) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Alojamento id</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($reserva->fornecedor_id) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Cliente id</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($reserva->cliente_id) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Funcionario id</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($reserva->funcionario_id) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
