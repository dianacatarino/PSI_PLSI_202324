<?php
use common\models\Fornecedor;
use common\models\Profile;
use common\models\Reserva;
use backend\models\Empresa;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Criar nova Fatura';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Criar nova Fatura</h3>
    </div>
    <?php $form = ActiveForm::begin(['action' => ['faturas/pesquisa'], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
    <div class="card-body">
        <div class="col-md-8">
            <?= $form->field($fatura, 'reserva_id')->dropDownList(
                $selectReservas,
                ['prompt' => 'Selecione uma reserva', 'class' => 'form-control']
            )->label('ID da Reserva') ?>
        </div>

        <div class="col-md-2" style="padding-top: 30px;">
            <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
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
</div>