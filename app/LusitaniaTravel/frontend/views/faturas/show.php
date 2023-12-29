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
                    <th scope="row">Valor</th>
                    <td><?= Html::encode($fatura->totalf) ?> €</td>
                </tr>
                <tr>
                    <th scope="row">Valor Sem Iva</th>
                    <td><?= Html::encode($fatura->totalsi) ?> €</td>
                </tr>
                <tr>
                    <th scope="row">Iva</th>
                    <td><?= Html::encode($fatura->iva) ?> %</td>
                </tr>
                <tr>
                    <th scope="row">Empresa</th>
                    <td><?= Html::encode($fatura->empresa->sede) ?></td>
                </tr>
                <tr>
                    <th scope="row">Reserva</th>
                    <td><?= Html::encode($fatura->reserva_id) ?></td>
                </tr>
                <tr>
                    <th scope="row">Data Fatura</th>
                    <td><?= Html::encode($fatura->data) ?></td>
                </tr>

                </tbody>
            </table>

            <table class="table detalhes-fatura-table">
                <thead>
                <tr>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($fatura->linhasfaturas as $linha): ?>
                    <tr>
                        <td><?= Html::encode($linha->quantidade) ?></td>
                        <td><?= Html::encode($linha->precounitario) ?> €</td>
                        <td><?= Html::encode($linha->subtotal) ?> €</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

    <div style="height: 20px;"></div>
</div>
