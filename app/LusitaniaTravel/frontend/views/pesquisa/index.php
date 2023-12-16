<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Pesquisa';
?>
<div class="site-index">
    <div class="body-content">

        <div class="container-fluid p-0 mb-5">
            <div class="d-flex justify-content-center">
                <h1 class="mb-1"></h1>
            </div>
        </div>

        <!-- Booking Start -->
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 50px;"> <!-- Ajusta a margem superior aqui -->
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">

                    <?php $form = ActiveForm::begin(['action' => ['pesquisa/search'], 'method' => 'get']); ?>

                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-2">
                                    <?= $form->field($searchModel, 'localizacao')->textInput(['placeholder' => 'Localização'])->label(false) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($searchModel, 'checkin')->textInput(['type' => 'date'])->label(false) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($searchModel, 'checkout')->textInput(['type' => 'date'])->label(false) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($searchModel, 'numeroPessoas')->dropDownList(
                                        ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'],
                                        ['prompt' => 'Pessoas']
                                    )->label(false) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($searchModel, 'numeroQuartos')->dropDownList(
                                        ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'],
                                        ['prompt' => 'Quartos']
                                    )->label(false) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary w-100']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
        <!-- Booking End -->
    </div>
</div>