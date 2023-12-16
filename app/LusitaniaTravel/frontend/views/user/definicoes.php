<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Definições';
?>

<div class="definicoes">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['user/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h3>Definições</h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Configurações de Conta</h5>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($user, 'username')->textInput(['placeholder' => 'Nome de Utilizador']) ?>

            <?= $form->field($profile, 'name')->textInput(['placeholder' => 'Nome']) ?>

            <?= $form->field($user, 'email')->textInput(['placeholder' => 'Email']) ?>

            <?= $form->field($profile, 'mobile')->textInput(['placeholder' => 'Telefone']) ?>

            <?= $form->field($profile, 'street')->textInput(['placeholder' => 'Morada']) ?>

            <?= $form->field($profile, 'locale')->textInput(['placeholder' => 'Localidade']) ?>

            <?= $form->field($profile, 'postalCode')->textInput(['placeholder' => 'Código Postal']) ?>

            <div style="height: 20px;"></div>
            <div class="form-group">
                <?= Html::submitButton('Salvar Alterações', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div style="height: 20px;"></div>
</div>