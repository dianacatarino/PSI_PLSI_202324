<?php

use yii\bootstrap5\Html;

$this->title = 'Detalhes da Linha de Fatura';
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
        <?= Html::a('Voltar', ['faturas/index'], ['class' => 'btn btn-secondary']) ?>
    </p>
</div>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalhes da Linha de Fatura <?= $linhafatura->id ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Quantidade</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($linhafatura->quantidade) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Preço Unitário</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($linhafatura->precounitario) ?>€</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Id da Linha de Reserva</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= Html::encode($linhafatura->linhasreservas_id) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
