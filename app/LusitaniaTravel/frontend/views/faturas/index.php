<?php

use common\models\Prestacao;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Faturas';
?>

<div class="faturas">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['user/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h3>Faturas</h3>

    <?php foreach ($faturas as $fatura): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= Html::encode('Fatura ' . $fatura->id) ?></h5>

                <table class="table faturas-table">
                    <tbody>
                    <tr>
                        <th scope="row">Valor</th>
                        <td><?= Html::encode($fatura->totalf) ?> €</td>
                    </tr>
                    <tr>
                        <th scope="row">Reserva</th>
                        <td><?= Html::encode($fatura->reserva_id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data Fatura</th>
                        <td><?= Html::encode($fatura->data) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Download</th>
                        <td>
                            <?= Html::a(
                                '<i class="fas fa-download"></i> Download',
                                ['faturas/download', 'id' => $fatura->id],
                                ['class' => 'btn btn-success']
                            ) ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <?= Html::a('Detalhes', ['faturas/show', 'id' => $fatura->id], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
