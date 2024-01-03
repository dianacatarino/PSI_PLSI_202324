<?php
/*
use common\models\Reserva;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Criar nova Fatura';

$script = <<<JS
$('#reserva-id').change(function() {
    var reservaId = $(this).val();
    $.ajax({
        url: 'get-reserva-info?id=' + reservaId,
        type: 'get',
        success: function(response) {
            // Preencher os campos associados à reserva automaticamente
            $('#cliente-id').val(response.cliente_id).prop('readonly', true);
            $('#cliente-nome').val(response.cliente_nome).prop('readonly', true);
            
            // Preencher os campos relacionados ao fornecedor
            $('#fornecedor-id').val(response.fornecedor_id).prop('readonly', true);
            $('#fornecedor-nome').val(response.fornecedor_nome).prop('readonly', true);
        },
        error: function() {
            console.log('Erro ao obter detalhes da reserva.');
        }
    });
});
JS;

$this->registerJs($script);
*/?><!--

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Criar nova Fatura</h3>
    </div>
    <div class="card-body">
        <?php /*$form = ActiveForm::begin(); */?>

        <div class="col-md-4">
            <?php /*= $form->field($reserva, 'id')->dropDownList($selectReservas, [
                'prompt' => 'Selecione uma reserva',
                'class' => 'form-control',
                'id' => 'reserva-id',
            ])->label('Reserva Id') */?>
        </div>

        <div class="col-md-6">
            <?php /*= $form->field($reserva, 'cliente_id')->textInput(['id' => 'cliente-id'])->label('ID do Cliente') */?>
        </div>

        <div class="col-md-6">
            <?php /*= $form->field($reserva, 'fornecedor_id')->textInput(['id' => 'fornecedor-id'])->label('ID do Fornecedor') */?>

        </div>

        <?php /*ActiveForm::end(); */?>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?php /*= Html::a('Cancelar', ['faturas/index'], ['class' => 'btn btn-secondary']) */?>
                </div>
                <div class="float-right">
                    <?php /*= Html::submitButton('Gerar Fatura', ['class' => 'btn btn-success']) */?>
                </div>
            </div>
        </div>
    </div>
</div>
-->