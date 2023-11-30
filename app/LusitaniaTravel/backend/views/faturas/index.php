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
                    <th style="width: 1%">Referência</th>
                    <th style="width: 5%">Quantidade</th>
                    <th style="width: 5%">Preço unitário</th>
                    <th style="width: 5%">Percentagem Iva</th>
                    <!--TODO:<th style="width: 5%">Valor Iva</th> -->
                    <th style="width: 5%">Subtotal</th>
                    <!--TODO:<th style="width: 1%">Valor total</th>-->
                </tr>
                </thead>
                <tbody>
                <?php foreach ($linhasfaturas as $linhasfatura): ?>
                    <tr>
                        <td><?= $linhasfatura->id ?></td>
                        <td></td>
                        <td><?= Html::encode($linhasfatura->quantidade) ?></td>
                        <td><?= Html::encode($linhasfatura->precounitario) ?></td>
                        <!--TODO:Falta a percentagem do iva -->
                        <td><?= Html::encode($linhasfatura->iva) ?></td>
                        <td><?= Html::encode($linhasfatura->subtotal) ?></td>
                        <!--TODO: Falta a percentagem do valor total -->
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['faturas/show', 'id' => $linhasfatura->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['faturas/edit', 'id' => $linhasfatura->id], ['class' => 'btn btn-info btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['faturas/delete', 'id' => $linhasfatura->id], [
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

