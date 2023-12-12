<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Carrinho de Compras';
?>
<div class="container mt-4">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['site/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <div class="card">
        <div class="card-header bg-dark text-white">
            Carrinho de Compras
        </div>
        <div class="card-body p-0">
            <?php if (!empty($itensCarrinho)) : ?>
                <table class="table mb-0">
                    <thead class="thead-dark">
                    <tr>
                        <th>Reserva</th>
                        <th>Número de Noites</th>
                        <th>Preço por Noite</th>
                        <th>Preço Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($itensCarrinho as $item) : ?>
                        <tr>
                            <td><?= Html::encode($item->reserva->id) ?></td>
                            <td><?= Html::encode($item->quantidade) ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($item->subtotal, 'EUR') ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($item->preco, 'EUR') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <td><?= Yii::$app->formatter->asCurrency($totalCarrinho, 'EUR') ?></td>
                    </tr>
                    </tfoot>
                </table>

                <div class="text-right p-3">
                    <p class="font-weight-bold">Total a Pagar: <?= Yii::$app->formatter->asCurrency($totalCarrinho, 'EUR') ?></p>
                    <?= Html::a('Finalizar Compra', ['carrinho/finalizar-compra'], ['class' => 'btn btn-success']) ?>
                </div>
            <?php else : ?>
                <p class="p-3 text-center">O carrinho está vazio.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
