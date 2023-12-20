<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

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
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 50px;">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="row g-2">
                        <div class="col-md-8">
                            <?= $form->field($fornecedorModel, 'localizacao_alojamento')->textInput(['placeholder' => 'Localização'])->label(false) ?>
                        </div>
                        <div class="col-md-4">
                            <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary w-100']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <!-- Booking End -->
        <?php if ($dataProvider): ?>
            <div class="container">
                <div class="row">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_result',
                        'summary' => '',
                        'options' => ['class' => 'list-view'],
                        'itemOptions' => [
                            'class' => 'col-md-4', // Certifique-se de ajustar a classe conforme necessário
                            'style' => 'margin-bottom: 15px;', // Adicione margem inferior se desejar
                        ],
                        'layout' => '<div class="row">{items}</div>{pager}',
                    ]) ?>
                </div>
            </div>
        <?php endif; ?>

        <div style="height: 20px;"></div>
    </div>
</div>
