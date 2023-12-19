<?php
use yii\helpers\Html;

$this->title = 'Gestão de Faturas';
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
        <?= Html::a('Criar nova Fatura', ['faturas/create2'], ['class' => 'btn btn-info']) ?>
    </p>
</div>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Faturas</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 5%">ID da Fatura</th>
                    <th style="width: 5%">Total da Fatura</th>
                    <th style="width: 5%">Total sem Iva</th>
                    <th style="width: 5%">Percentagem de Iva</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($faturas as $fatura): ?>
                    <tr>
                        <td><?= Html::encode($fatura->id) ?></td>
                        <td><?= Html::encode($fatura->totalf) ?></td>
                        <td><?= Html::encode($fatura->totalsi) ?></td>
                        <td><?= Html::encode($fatura->iva) ?></td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['faturas/show', 'id' => $reserva->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['faturas/edit', 'id' => $reserva->id], ['class' => 'btn btn-info btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['faturas/delete', 'id' => $reserva->id], [
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

