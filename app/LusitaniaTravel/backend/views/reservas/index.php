<?php

use yii\helpers\Html;
use yii\bootstrap5\LinkPager;

$this->title = 'Gestão de Reservas';
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
        <?= Html::a('Criar nova Reserva', ['reservas/create'], ['class' => 'btn btn-info']) ?>
    </p>
</div>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Reservas</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 5%">Id</th>
                    <th style="width: 1%">Tipo</th>
                    <th style="width: 5%">Check-in</th>
                    <th style="width: 5%">Check-out</th>
                    <th style="width: 3%">Pessoas</th>
                    <th style="width: 3%">Quartos</th>
                    <th style="width: 3%">Valor Total</th>
                    <th style="width: 5%">Alojamento</th>
                    <th style="width: 5%">Cliente</th>
                    <th style="width: 5%">Funcionário</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td><?= Html::encode($reserva->id) ?></td>
                        <td><?= Html::encode($reserva->tipo) ?></td>
                        <td><?= Html::encode($reserva->checkin) ?></td>
                        <td><?= Html::encode($reserva->checkout) ?></td>
                        <td><?= Html::encode($reserva->numeroclientes) ?></td>
                        <td><?= Html::encode($reserva->numeroquartos) ?></td>
                        <td><?= Html::encode($reserva->valor) ?>€</td>
                        <td><?= Html::encode($reserva->fornecedor->nome_alojamento) ?></td>
                        <td><?= Html::encode($reserva->cliente->profile->name) ?></td>
                        <td><?= Html::encode($reserva->funcionario->profile->name) ?></td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#collapseLinhasReserva<?= $reserva->id ?>">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <?= Html::a('<i class="fas fa-plus"></i>', ['linhasreservas/create', 'reservas_id' => $reserva->id], ['class' => 'btn btn-success btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-folder"></i>', ['reservas/show', 'id' => $reserva->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['reservas/edit', 'id' => $reserva->id], ['class' => 'btn btn-info btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['reservas/delete', 'id' => $reserva->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Linhas de Reservas -->
                    <tr id="collapseLinhasReserva<?= $reserva->id ?>" class="collapse">
                        <td colspan="10">
                            <table>
                                <thead>
                                <tr>
                                    <th style="width: 5%">Tipo de Quarto</th>
                                    <th style="width: 5%">Nº Noites</th>
                                    <th style="width: 5%">Nº Camas</th>
                                    <th style="width: 10%">Valor por Noite</th>
                                    <th style="width: 1%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($reserva->linhasreservas as $linhareserva): ?>
                                    <tr>
                                        <td><?= Html::encode($linhareserva->tipoquarto) ?></td>
                                        <td><?= Html::encode($linhareserva->numeronoites) ?></td>
                                        <td><?= Html::encode($linhareserva->numerocamas) ?></td>
                                        <td><?= Html::encode($linhareserva->subtotal) ?>€</td>
                                        <td class="project-actions text-right">
                                            <div class="btn-group">
                                                <?= Html::a('<i class="fas fa-folder"></i>', ['linhasreservas/show', 'id' => $linhareserva->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['linhasreservas/edit', 'id' => $linhareserva->id], ['class' => 'btn btn-info btn-sm']) ?>
                                                <?= Html::a('<i class="fas fa-trash"></i>', ['linhasreservas/delete', 'id' => $linhareserva->id], [
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                    ],
                                                ]) ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <nav aria-label="Page navigation">
                <?= LinkPager::widget([
                    'pagination' => $pagination,
                    'options' => ['class' => 'pagination justify-content-end'],
                    'linkContainerOptions' => ['class' => 'page-item'],
                    'linkOptions' => ['class' => 'page-link'],
                    'prevPageLabel' => '<span aria-hidden="true">&laquo;</span><span class="sr-only">Anterior</span>',
                    'nextPageLabel' => '<span aria-hidden="true">&raquo;</span><span class="sr-only">Próxima</span>',
                ]); ?>
            </nav>
        </div>
    </div>
</section>
