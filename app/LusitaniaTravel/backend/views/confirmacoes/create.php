<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Reserva;
use common\models\Fornecedor;

$this->title = 'Criar Confirmação';
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Confirmação</h3>
    </div>
    <?php $form = ActiveForm::begin(['action' => ['confirmacao/store'], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
    <div class="card-body">
        <div class="form-group">
            <?= $form->field($confirmacao, 'estado')->dropDownList(['Pendente' => 'Pendente', 'Confirmado' => 'Confirmado', 'Cancelado' => 'Cancelado'], ['class' => 'form-control'])->label('Estado da Confirmação') ?>
        </div>
        <div class="form-group">
            <?= $form->field($confirmacao, 'data_confirmacao')->input('date',['class' => 'form-control'])->label('Data da Confirmação') ?>
        </div>
        <div class="form-group">
            <?= $form->field($confirmacao, 'reserva_id')->dropDownList(
                ArrayHelper::map(Reserva::find()->all(), 'id', 'id'),
                ['prompt' => 'Selecionar Reserva', 'class' => 'form-control']
            )->label('Id da Reserva') ?>
        </div>
        <div class="form-group">
            <?= $form->field($confirmacao, 'alojamento_id')->dropDownList(
                ArrayHelper::map(Fornecedor::find()->all(), 'id', 'id'),
                ['prompt' => 'Selecionar Alojamento', 'class' => 'form-control']
            )->label('Id do Alojamento') ?>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?= Html::a('Cancelar', ['confirmacao/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="float-right">
                    <?= Html::submitButton('Criar Confirmação', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

