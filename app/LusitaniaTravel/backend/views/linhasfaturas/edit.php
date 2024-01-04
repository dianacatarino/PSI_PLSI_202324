<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Linha de Fatura';
?>

<div class="card card-primary linhasfaturas-edit">

    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
    </div>

    <?php $form = ActiveForm::begin(['action' => ['linhasfaturas/edit', 'id' => $linhafatura->id], 'method' => 'post', 'options' => ['class' => 'container']]); ?>

    <div class="card-body">
        <div class="form-group">
            <?= $form->field($linhafatura, 'quantidade')->input('number', ['min' => 1])->label('Quantidade') ?>
        </div>

        <div class="form-group">
            <?= $form->field($linhafatura, 'precounitario')->textInput(['type' => 'number', 'step' => '0.01'])->label('Preço Unitário') ?>
        </div>

        <div class="form-group">
            <?= Html::label('Id Linha de Reserva', 'linhasreservas_id', ['class' => 'control-label']) ?>
            <?= Html::textInput('linhasreservas_id', $linhafatura->linhasreservas_id, ['class' => 'form-control', 'readonly' => true]) ?>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?= Html::a('Cancelar', ['faturas/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="float-right">
                    <?= Html::submitButton('Editar Linha Fatura', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
