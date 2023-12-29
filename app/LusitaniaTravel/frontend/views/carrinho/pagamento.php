<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $reserva common\models\Reserva */

$this->title = 'Finalizar Reserva';

?>
<h3>Pagamento da Reserva</h3>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Informações de Pagamento</h5>

        <?= DetailView::widget([
            'model' => $reserva,
            'attributes' => [
                [
                    'label' => 'Entidade',
                    'value' => 21223, // Fixed value
                ],
                [
                    'label' => 'Referencia',
                    'value' => 'REF' . str_pad($reserva->id, 8, '0', STR_PAD_LEFT), // Using the ID of the reservation
                ],
                'valor' => [
                    'label' => 'Valor',
                    'value' => Yii::$app->formatter->asCurrency($reserva->valor, 'EUR'),
                ],
            ],
        ]) ?>

        <div class="form-group">
            <?= Html::a('Download', ['carrinho/download', 'id' => $reserva->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>

