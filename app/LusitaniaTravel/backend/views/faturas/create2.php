<?php

use common\models\Fornecedor;
use common\models\Profile;
use common\models\Reserva;
use backend\models\Empresa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Criar nova Fatura';

$url = Url::to(['faturas/get-reserva-info']);
$script = <<< JS
    $('#reserva-dropdown').change(function(){
        var reservaId = $(this).val();
        $('#reserva-id-input').val(reservaId);
        $.ajax({
            url: '$url',
            type: 'GET',
            data: {id: reservaId},
            dataType: 'json',
            success: function(data) {
                $('#fornecedor-input').val(data.fornecedor_nome_alojamento);
                $('#cliente-input').val(data.cliente_profile_name);
                $('#cliente-id-input').val(data.cliente_id); 
                $('#fornecedor-id-input').val(data.fornecedor_id); 
            },
            error: function() {
                console.log('Erro ao obter informações da reserva.');
            }
        });
    });
JS;
$this->registerJs($script);
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Criar nova Fatura</h3>
    </div>
    <?php $form = ActiveForm::begin(['action' => ['faturas/create2'], 'method' => 'get', 'options' => ['class' => 'container']]); ?>
    <div class="card-body">
        <?= $form->field($reservaModel, 'id')->hiddenInput(['id' => 'reserva-id-input'])->label(false) ?>
        <?= $form->field($reservaModel, 'cliente_id')->hiddenInput(['id' => 'cliente-id-input'])->label(false) ?> 
        <?= $form->field($reservaModel, 'fornecedor_id')->hiddenInput(['id' => 'fornecedor-id-input'])->label(false) ?> 
        <div class="col-md-4">
            <?= $form->field($reservaModel, 'id')->dropDownList($selectReservas, [
                'prompt' => 'Selecione uma reserva',
                'class' => 'form-control',
                'id' => 'reserva-dropdown',
            ])->label('Reserva Id') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($reservaModel, 'fornecedor_nome_alojamento')->textInput(['id' => 'fornecedor-input', 'placeholder' => 'Pesquise Fornecedor', 'readonly' => true])->label('Alojamento') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($reservaModel, 'cliente_profile_name')->textInput(['id' => 'cliente-input', 'placeholder' => 'Pesquise Cliente', 'readonly' => true])->label('Cliente') ?>
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
