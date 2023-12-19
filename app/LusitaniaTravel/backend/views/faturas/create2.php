<?php

use backend\models\Fornecedor;
use common\models\Profile;
use common\models\Reserva;
use backend\models\Empresa;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Criar nova Fatura';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Criar nova Fatura</h3>
    </div>
    <?php $form = ActiveForm::begin(['action' => ['faturas/show'], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
    <div class="card-body">
        <div class="form-group">
            <?= $form->field($fatura, 'reserva_id')->dropDownList(
                Reserva::find()
                    ->select(['id']) // Ajuste para os campos corretos
                    ->indexBy('id')
                    ->column(),
                ['prompt' => 'Selecione uma reserva', 'class' => 'form-control']
            )->label('Referência da Reserva') ?>

        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?= Html::a('Cancelar', ['faturas/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="float-right">
                    <?= Html::submitButton('Gerar Fatura', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>


