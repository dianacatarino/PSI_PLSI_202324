<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Adicionar Linha de Reserva';
?>

<div class="card card-primary linhasreservas-create">

    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="card-body">
        <div class="form-group">
            <?= $form->field($linhasreserva, 'tipoquarto')->dropDownList(
                [
                    'Quarto Individual' => 'Quarto Individual',
                    'Quarto Duplo' => 'Quarto Duplo',
                    'Quarto Triplo' => 'Quarto Triplo',
                    'Quarto Familiar' => 'Quarto Familiar',
                    'Villa' => 'Villa',
                ],
                ['prompt' => 'Selecione o Tipo de Quarto']
            )->label('Tipo de Quarto') ?>
        </div>

        <div class="form-group">
            <?php echo $form->field($linhasreserva, 'numeronoites')->input('number', ['min' => 1, 'max' => 31, 'value' => $linhasreserva->calcularNoites($reserva), 'readonly' => true])->label('Nº Noites'); ?>
        </div>

        <div class="form-group">
            <?= $form->field($linhasreserva, 'numerocamas')->input('number', ['min' => 1, 'max' => 6, 'value' => $linhasreserva->calcularNumeroCamas($linhasreserva->tipoquarto)])->label('Nº Camas') ?>
        </div>

        <div class="form-group">
            <?= $form->field($linhasreserva, 'subtotal')->textInput(['type' => 'number', 'step' => '0.01', 'readonly' => true, 'value' => $linhasreserva->calcularSubtotal($reserva)]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($linhasreserva, 'reservas_id')->hiddenInput(['value' => $reservas_id])->label(false) ?>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?= Html::a('Cancelar', ['reservas/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="float-right">
                    <?= Html::submitButton('Adicionar Linha Reserva', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
