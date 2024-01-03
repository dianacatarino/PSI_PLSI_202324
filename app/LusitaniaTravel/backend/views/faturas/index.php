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
        <?= Html::a('Criar nova Fatura', ['faturas/create'], ['class' => 'btn btn-info']) ?>
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
                    <th style="width: 5%">Id</th>
                    <th style="width: 5%">Total </th>
                    <th style="width: 5%">Total S/Iva</th>
                    <th style="width: 5%">% de Iva</th>
                    <th style="width: 5%">Reserva</th>
                    <th style="width: 5%">Data</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($faturas as $fatura): ?>
                    <tr>
                        <td><?= Html::encode($fatura->id) ?></td>
                        <td><?= Html::encode($fatura->totalf) ?>€</td>
                        <td><?= Html::encode($fatura->totalsi) ?>€</td>
                        <td><?= Html::encode($fatura->iva) ?>%</td>
                        <td><?= Html::encode($fatura->reserva_id) ?></td>
                        <td><?= Html::encode($fatura->data) ?></td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#collapseLinhasFatura<?= $fatura->id ?>">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <?= Html::a('<i class="fas fa-folder"></i>', ['faturas/show', 'id' => $fatura->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['faturas/edit', 'id' => $fatura->id], ['class' => 'btn btn-info btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['faturas/delete', 'id' => $fatura->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </td>
                    </tr>
                    <!-- Linhas de Faturas -->
                    <tr id="collapseLinhasFatura<?= $fatura->id ?>" class="collapse">
                        <td colspan="10">
                            <table>
                                <thead>
                                <tr>
                                    <th style="width: 5%">Quantidade</th>
                                    <th style="width: 5%">Preço Unitário</th>
                                    <th style="width: 10%">Linha Reserva</th>
                                    <th style="width: 1%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($fatura->linhasfaturas as $linhafatura): ?>
                                    <tr>
                                        <td><?= Html::encode($linhafatura->quantidade) ?></td>
                                        <td><?= Html::encode($linhafatura->precounitario) ?>€</td>
                                        <td><?= Html::encode($linhafatura->linhasreservas_id) ?></td>
                                        <td class="project-actions text-right">
                                            <div class="btn-group">
                                                <?= Html::a('<i class="fas fa-folder"></i>', ['linhasfaturas/show', 'id' => $linhafatura->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['linhasfaturas/edit', 'id' => $linhafatura->id], ['class' => 'btn btn-info btn-sm']) ?>
                                                <?= Html::a('<i class="fas fa-trash"></i>', ['linhasfaturas/delete', 'id' => $linhafatura->id], [
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
    </div>
</section>

