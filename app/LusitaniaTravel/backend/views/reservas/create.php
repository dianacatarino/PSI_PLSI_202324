<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Criar nova Reserva';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Criar nova Reserva</h3>
    </div>
    <!--<form action="" method="post" class="container">-->
        <?php $form = ActiveForm::begin(['action' => ['reservas/create'], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
        <div class="card-body">
            <div class="form-group"> <!--TODO: ATENÇÃO VER SE BASE DE D-->
                <?= $form->field($reserva, 'tipo')->textInput(['class' => 'form-control'])->label('Tipo') ?>
            </div>
            <div class="form-group">
                <?= $form->field($reserva, 'checkin')->textInput(['class' => 'form-control'])->label('Check-in') ?>
            </div>
            <div class="form-group">
                <?= $form->field($reserva, 'checkout')->textInput(['class' => 'form-control'])->label('Check-out') ?>
            </div>
            <div class="form-group">
                <?= $form->field($reserva, 'numeroclientes')->textInput(['class' => 'form-control'])->label('Nº de Clientes') ?>
            </div>
            <div class="form-group">
                <?= $form->field($reserva, 'numeroquartos')->textInput(['class' => 'form-control'])->label('Nº de Quartos') ?>
            </div>
            <div class="form-group">
                <?= $form->field($reserva, 'valor')->textInput(['class' => 'form-control'])->label('Preço por noite') ?>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12">
                    <div class="float-left">
                        <?= Html::a('Cancelar', ['reservas/index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                    <div class="float-right">
                        <?= Html::submitButton('Criar Reserva',  ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    <!--</form>-->
</div>

