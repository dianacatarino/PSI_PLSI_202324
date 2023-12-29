<?php

use common\models\Faturas; // Certifique-se de usar o namespace correto para o modelo de Faturas
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Fatura';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Fatura</h3>
    </div>
    <?php $form = ActiveForm::begin([
        'action' => ['faturas/edit', 'id' => $fatura->id], // Ajuste a ação conforme necessário
        'method' => 'post',
        'options' => ['class' => 'container'],
    ]); ?>
    <div class="card-body">
        <?= $form->field($fatura, 'totalf')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($fatura, 'totalsi')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($fatura, 'iva')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($fatura, 'reserva_id')->dropDownList(
            $selectReservas,
            ['prompt' => 'Selecione uma reserva', 'class' => 'form-control']
        )->label('Reserva') ?>
        <?= $form->field($fatura, 'data')->input('date', ['class' => 'form-control'])->label('Data Fatura') ?>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?= Html::a('Cancelar', ['faturas/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="float-right">
                    <?= Html::submitButton('Editar Fatura', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>