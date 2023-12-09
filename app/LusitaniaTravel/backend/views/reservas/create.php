<?php

use common\models\Fornecedor;
use common\models\Profile;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Criar nova Reserva';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Reserva</h3>
    </div>
    <?php $form = ActiveForm::begin(['action' => ['reservas/create'], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
    <div class="card-body">
        <div class="form-group">
            <?= $form->field($reserva, 'tipo')->dropDownList(
                [
                    'Presencial' => 'Presencial',
                    'Online' => 'Online',
                ],
                ['prompt' => 'Selecione um tipo', 'class' => 'form-control']
            )->label('Tipo') ?>
        </div>
        <div class="form-group">
            <?= $form->field($reserva, 'checkin')->input('date', ['class' => 'form-control'])->label('Check In') ?>
        </div>
        <div class="form-group">
            <?= $form->field($reserva, 'checkout')->input('date', ['class' => 'form-control'])->label('Check Out') ?>
        </div>
        <div class="form-group">
            <?= $form->field($reserva, 'numeroquartos')->input('number', [
                'class' => 'form-control',
                'min' => 1,
                'max' => 6,
            ])->label('Numero de Quartos') ?>
        </div>

        <div class="form-group">
            <?= $form->field($reserva, 'numeroclientes')->input('number', [
                'class' => 'form-control',
                'min' => 1,
                'max' => 10,
            ])->label('Numero de Clientes') ?>
        </div>
        <div class="form-group">
            <?= $form->field($reserva, 'valor')->textInput(['class' => 'form-control'])->label('Valor Total') ?>
        </div>
        <div class="form-group">
            <?= $form->field($reserva, 'fornecedor_id')->dropDownList(
                $selectAlojamentos,
                ['prompt' => 'Selecione um alojamento', 'class' => 'form-control']
            )->label('Alojamento') ?>
        </div>

        <div class="form-group">
            <?= $form->field($reserva, 'cliente_id')->dropDownList(
                $selectClientes,
                ['prompt' => 'Selecione um cliente', 'class' => 'form-control']
            )->label('Cliente') ?>
        </div>

        <div class="form-group">
            <?= $form->field($reserva, 'funcionario_id')->dropDownList(
                $selectFuncionarios,
                ['prompt' => 'Selecione um funcionário', 'class' => 'form-control']
            )->label('Funcionário') ?>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?= Html::a('Cancelar', ['reservas/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="float-right">
                    <?= Html::submitButton('Criar Reserva', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
