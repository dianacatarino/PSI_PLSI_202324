<?php

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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= Html::encode('Fatura ' . $fatura->id) ?></h5>

                <table class="table faturas-table">
                    <tbody>
                    <tr>
                        <th scope="row">Data</th>
                        <td><?= Html::encode($fatura->data) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Valor</th>
                        <td><?= Html::encode($fatura->valor) ?> €</td>
                    </tr>
                    <tr>
                        <th scope="row">IVA</th>
                        <td><?= Html::encode($fatura->iva) ?> €</td>
                    </tr>

                    <tr>
                        <th scope="row">Download</th>
                        <td>
                            <?= Html::a(
                                '<i class="fas fa-download"></i> Download',
                                ['faturas/view', 'id' => $fatura->id],
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
