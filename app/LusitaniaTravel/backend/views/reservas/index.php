<?php

use yii\helpers\Html;

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
                    <th style="width: 5%">ID do Alojamento</th>
                    <th style="width: 5%">Check-in</th>
                    <th style="width: 5%">Check-out</th>
                    <th style="width: 5%">Nºde Clientes</th>
                    <th style="width: 5%">Nº de Quartos</th>
                    <th style="width: 5%">Preço por noite</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td><?= $reserva->id ?></td>
                        <td><?= Html::encode($reserva->checkin) ?></td>
                        <td><?= Html::encode($reserva->checkout) ?></td>
                        <td><?= Html::encode($reserva->numeroclientes) ?></td>
                        <td><?= Html::encode($reserva->numeroquartos) ?></td>
                        <td><?= Html::encode($reserva->valor) ?></td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
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
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
