<?php

use yii\helpers\Html;

$this->title = 'Detalhes da Fatura';

?>

<div class="detalhes-fatura">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Fatura #1</h5>

            <table class="table detalhes-fatura-table">
                <tbody>
                <tr>
                    <th scope="row">Total Fatura</th>
                    <td>200 €</td>
                </tr>
                <tr>
                    <th scope="row">Total S/ IVA</th>
                    <td>100 €</td>
                </tr>
                <tr>
                    <th scope="row">IVA</th>
                    <td>200 €</td>
                </tr>
                <tr>
                    <th scope="row">Data da Fatura</th>
                    <td>2023-02-20</td>
                </tr>
                </tbody>
            </table>

            <!-- Adicione mais detalhes ou botões conforme necessário -->

            <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
</div>

