<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Definições';

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <!-- Definições Form -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- Definições Form Content -->
                    <div class="card">
                        <div class="card-body">

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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

