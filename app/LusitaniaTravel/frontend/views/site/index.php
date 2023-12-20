<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->title = 'Lusitânia Travel';
?>
<div class="site-index">
    <div class="body-content">

        <div class="container-fluid p-0 mb-5">
            <div class="d-flex justify-content-center">
                <img src="/LusitaniaTravel/frontend/public/img/logo_vertical.png" alt="Image" style="max-width: 500px; height: auto;">
            </div>
        </div>


        <!-- Booking Start -->
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-2">
                                    <?= $form->field($searchModel, 'localizacao_alojamento')->textInput(['placeholder' => 'Localização'])->label(false) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($searchModel, 'checkin')->textInput(['type' => 'date'])->label(false) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($searchModel, 'checkout')->textInput(['type' => 'date'])->label(false) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($searchModel, 'numeroclientes')->dropDownList(
                                        ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'],
                                        ['prompt' => 'Pessoas']
                                    )->label(false) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($searchModel, 'numeroquartos')->dropDownList(
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

        <div style="height: 20px;"></div>

        <div class="container">
            <div class="row">
                <?php if (!$searchModel->validate() || !$dataProvider || !$searchModel->isFilled() || !$fornecedores) : ?>
                    <?= ListView::widget([
                        'dataProvider' => $fornecedores,
                        'itemView' => '_item',
                        'summary' => '',
                        'options' => ['class' => 'list-view'],
                        'itemOptions' => [
                            'class' => 'col-md-4',
                            'style' => 'margin-bottom: 15px;',
                        ],
                        'layout' => '<div class="row">{items}</div>{pager}',
                    ]) ?>
                <?php else : ?>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_item',
                        'summary' => '',
                        'options' => ['class' => 'list-view'],
                        'itemOptions' => [
                            'class' => 'col-md-4',
                            'style' => 'margin-bottom: 15px;',
                        ],
                        'layout' => '<div class="row">{items}</div>{pager}',
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
