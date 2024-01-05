<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Confirmação';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Confirmação</h3>
    </div>
    <?php $form = ActiveForm::begin(['action' => ['confirmacoes/edit', 'id' => $confirmacao->id], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
    <div class="card-body">
        <div class="form-group">
            <?= $form->field($confirmacao, 'estado')->dropDownList(['Pendente' => 'Pendente', 'Confirmado' => 'Confirmado', 'Cancelado' => 'Cancelado'], ['class' => 'form-control'])->label('Estado da Confirmação') ?>
        </div>
        <div class="form-group">
            <?= $form->field($confirmacao, 'reserva_id')->dropDownList(
                $selectReservas,
                ['prompt' => 'Selecione uma reserva', 'class' => 'form-control']
            )->label('Reserva'); ?>

        </div>
        <div class="form-group">
            <?= $form->field($confirmacao, 'fornecedor_id')->dropDownList(
                $selectAlojamentos,
                ['prompt' => 'Selecione um alojamento', 'class' => 'form-control']
            )->label('Alojamento') ?>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?= Html::a('Cancelar', ['confirmacoes/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="float-right">
                    <?= Html::submitButton('Editar Confirmação', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

