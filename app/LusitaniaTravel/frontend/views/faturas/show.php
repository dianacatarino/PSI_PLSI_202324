<?php

use yii\helpers\Html;

$this->title = 'Detalhes da Fatura';

?>

<div class="detalhes-fatura">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['faturas/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= Html::encode('Fatura ' . $fatura->id) ?></h5>

            <table class="table detalhes-fatura-table">
                <tbody>
                <tr>
                    <th scope="row">Total Fatura</th>
                    <td><?= Html::encode($fatura->totalf) ?> €</td>
                </tr>
                <tr>
                    <th scope="row">Total S/ IVA</th>
                    <td><?= Html::encode($fatura->totalsi) ?> €</td>
                </tr>
                <tr>
                    <th scope="row">IVA</th>
                    <td><?= Html::encode($fatura->iva) ?> €</td>
                </tr>
                <tr>
                    <th scope="row">Data da Fatura</th>
                    <td><?= Html::encode($fatura->data) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
