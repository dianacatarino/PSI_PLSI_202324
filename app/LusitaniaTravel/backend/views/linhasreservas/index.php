<?php

use yii\helpers\Html;

$this->title = 'Gestão de Linhas Reservas';
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
        <?= Html::a('Criar nova Linha Reserva', ['reservas/create'], ['class' => 'btn btn-info']) ?>
    </p>
</div>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Linha Reserva</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 5%">Id</th>
                    <th style="width: 5%">Tipo de Quarto</th>
                    <th style="width: 5%">Nº Noites</th>
                    <th style="width: 5%">Nº Camas</th>
                    <th style="width: 10%">Valor por Noite</th>
                    <th style="width: 10%">Reserva Id</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($linhasreservas as $linhareserva): ?>
                    <tr>
                        <td><?= Html::encode($linhareserva->id) ?></td>
                        <td><?= Html::encode($linhareserva->tipoquarto) ?></td>
                        <td><?= Html::encode($linhareserva->numeronoites) ?></td>
                        <td><?= Html::encode($linhareserva->numerocamas) ?></td>
                        <td><?= Html::encode($linhareserva->subtotal) ?>€</td>
                        <td><?= Html::encode($linhareserva->reservas_id) ?></td>
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
        </div>
    </div>
</section>
